<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Transformers\MediaTransformer;
use App\Http\Requests\MediaIndexRequest;
use App\Http\Requests\MediaStoreRequest;
use App\Http\Requests\MediaShowRequest;
use App\Http\Requests\MediaUpdateRequest;
use App\Http\Requests\MediaDestroyRequest;
use Illuminate\Http\JsonResponse;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Http\File;
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
            ->paginatedWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json($response);
    }

    /**
     * Store a Media
     * 
     * This endpoint lets you store a new Media
     * 
     * @param MediaStoreRequest $request
     * @return JsonResponse
     */
    public function store(MediaStoreRequest $request): JsonResponse
    {
        $file = $request->file;
        $user = Auth::user();
        $path = Storage::putFile('media', $request->file);
        $save = $user->media()->create([
            'path' => $path,
            'description' => $file->getClientOriginalName(),
        ]);
        if ($save) {
            return response()->success('New media item stored successfully');
        } else {
            return response()->error('Failed to stored new media');
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
    public function get(MediaShowRequest $request, Media $media)
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
            return response()->error('Failed to update media', 400);
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
        if ($media->delete()) {
            return response()->success('Media deleted successfully', 200);
        } else {
            return response()->error('Media not found', 404);
        }
    }
}
