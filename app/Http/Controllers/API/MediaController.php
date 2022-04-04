<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Transformers\MediaTransformer;
use App\Http\Requests\Media\MediaIndexRequest;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Requests\Media\MediaShowRequest;
use App\Http\Requests\Media\MediaUpdateRequest;
use App\Http\Requests\Media\MediaDestroyRequest;
use App\Http\Requests\Media\MediaDownloadRequest;
use Illuminate\Http\JsonResponse;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @group Media Management
 *
 * APIs for managing Media
 */
class MediaController extends Controller
{
    /**
     * Get all Media
     *
     * This endpoint lets you get all the Media
     *
     * @authenticated
     * @param MediaIndexRequest $request
     * @uses App\Models\Media $paginator
     * @uses App\Transformers\MediaTransformer MediaTransformer
     * @uses League\Fractal\Serializer\JsonApiSerializer JsonApiSerializer
     * @uses League\Fractal\Pagination\IlluminatePaginatorAdapter IlluminatePaginatorAdapter
     * @return JsonResponse
     */
    public function index(MediaIndexRequest $request): JsonResponse
    {
        $paginator = Media::paginate();
        $media = $paginator->getCollection();

        $response = fractal()
            ->collection($media)
            ->transformWith(new MediaTransformer())
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json($response);
    }

    /**
     * Store a Media
     *
     * This endpoint lets you store a new Media
     * @todo no private status handler
     *
     * @authenticated
     * @param MediaStoreRequest $request
     * @return JsonResponse
     */
    public function store(MediaStoreRequest $request): JsonResponse
    {
        $status = ($request->has("status")) ? $request->status : "public";
        $file = $request->file;
        $user = Auth::user();
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = preg_replace("/\s+/", "", $filename);
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

        $path = $request->file("file")->storeAs(
            "media",
            "$filename.$extension"
        );

        $url = ($status == "public") ? asset("storage/media/$filename.$extension") : "";
        $save = $user->media()->create([
            "path" => $path,
            "url" => $url,
            "status" => $status,
            "type" => $extension,
            "description" => $request->description,
            "meta" => ($request->has("meta")) ? $request->meta : null,
        ]);
        if ($save) {
            return response()->success([
                'id' => $save->id,
            ]);
        } else {
            return response()->error([], "Failed to stored new media");
        }
    }

    /**
     * Show a Media
     *
     * This endpoint lets you get a Media
     *
     * @authenticated
     * @todo 2nd parameter should auto resolve to the Media model instance
     * @param MediaShowRequest $request
     * @param int $id the id of the media to look for
     * @uses App\Transformers\MediaTransformer MediaTransformer
     * @return JsonResponse
     */
    public function show(MediaShowRequest $request, Media $media)
    {
        $response = fractal($media, new MediaTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Update a Media
     * This endpoint lets you update a Media File matching the provided ID.
     *
     * @authenticated
     * @param MediaUpdateRequest $request
     * @param Media $media
     * @return JsonResponse
     */
    public function update(MediaUpdateRequest $request, Media $media): JsonResponse
    {
        $media->path = $request->path;
        $media->description = $request->description;
        $media->status = $request->status;
        if ($media->update()) {
            $response = fractal($media, new MediaTransformer())->toArray();
            return response()->succes($response);
        } else {
            return response()->error([], "Failed to update media", 400);
        }
    }

    /**
     * Delete a Media
     *
     * This endpoint lets you delete a single Role
     *
     * @authenticated
     * @todo 2nd parameter should autoresolve to the Media model instance.
     * @todo add body parameter `force` that allows force delete when user is an admin.
     * @param MediaDeleteRequest $request
     * @param App\Models\Media $media auto resolved instance of Eloquent Role
     * @uses App\Models\Media $media
     * @return JsonResponse
     */
    public function destroy(MediaDestroyRequest $request, Media $media)
    {
        $media->delete();
        return response()->success("Media deleted successfully", 200);
    }

    public function download(MediaDownloadRequest $request, Media $media)
    {
        $public = ($media->status == "public") ? "public/" : "";
        $path = storage_path('app/' . $public . $media->path);
        if (is_dir($path) || !file_exists($path)) {
            return response()->error([], "Media doesn't exist", 404);
        }
        // return response()->download($path);

        $response = new StreamedResponse;

        $disposition = 'inline';
        $filename = basename($media->path);

        $disposition = $response->headers->makeDisposition(
            $disposition,
            $filename
        );

        $response->headers->replace([
            'Content-Type' => File::mimeType($path),
            'Content-Length' => File::size($path),
            'Content-Disposition' => $disposition,
        ]);

        $response->setCallback(function () use ($media) {
            $fs = Storage::getDriver();
            $stream = $fs->readStream($media->path);

            while (!feof($stream)) {
                echo fread($stream, 2048);
            }

            fclose($stream);
        });

        ini_set('max_execution_time', 8000000);

        return $response;
    }
}
