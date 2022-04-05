<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\UserMeta\UserMetaIndexRequest;
use App\Http\Requests\UserMeta\UserMetaStoreRequest;
use App\Http\Requests\UserMeta\UserMetaShowRequest;
use App\Http\Requests\UserMeta\UserMetaUpdateRequest;
use App\Http\Requests\UserMeta\UserMetaDestroyRequest;

/**
 * @group User Meta Management
 *
 * APIs for User Meta Management
 */
class UserMetaController extends Controller
{

    /**
     * Get all User Meta Data
     *
     * This endpoint lets you get all User Meta
     *
     * @authenticated
     * @param UserMetaIndexRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function index(UserMetaIndexRequest $request, User $user): JsonResponse
    {
        $meta = UserMeta::where('user_id', $user->id)->get();
        return response()->success($meta);
    }

    /**
     * Store User Meta
     *
     * This endpoint lets you store User Meta
     *
     * @authenticated
     * @param UserMetaStoreRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(UserMetaStoreRequest $request, User $user): JsonResponse
    {
        $meta = new UserMeta();
        $meta->user_id = $user->id;
        $meta->meta_key = $request->meta_key;
        $meta->meta_value = $request->meta_value;
        $meta->autoload = ($request->has('autoload')) ? $request->autoload : false;
        $meta->save();
        return response()->success();
    }

    /**
     * Show User Meta
     *
     * This endpoint will return a single User Meta
     *
     * @authenticated
     * @param UserMetaShowRequest $request
     * @param User $user
     * @param String $key
     * @return JsonResponse
     */
    public function show(UserMetaShowRequest $request, User $user, String $key): JsonResponse
    {
        $meta = UserMeta::where([
            'user_id' => $user->id,
            'meta_key' => $key,
        ])->first();
        return response()->success($meta);
    }

    /**
     * Update User Meta
     *
     * This endpoint will update a single User Meta
     *
     * @authenticated
     * @param UserMetaUpdateRequest $request
     * @param User $user
     * @param String $key
     * @return JsonResponse
     */
    public function update(UserMetaUpdateRequest $request, User $user, String $key): JsonResponse
    {
        $meta = UserMeta::where([
            'user_id' => $user->id,
            'meta_key' => $key,
        ])->first();
        $meta->meta_value = $request->meta_value;
        if ($request->has('autoload')) {
            $meta->autoload = $request->autoload;
        }
        $meta->save();
        return response()->success();
    }

    /**
     * Destroy User Meta
     *
     * This endpoint will destroy a single User Meta
     *
     * @authenticated
     * @param UserMetaDestroyRequest $request
     * @param User $user
     * @param String $key
     * @return JsonResponse
     */
    public function destroy(UserMetaDestroyRequest $request, User $user, String $key): JsonResponse
    {
        UserMeta::where([
            'user_id' => $user->id,
            'meta_key' => $key,
        ])->delete();
        return response()->success();
    }
}
