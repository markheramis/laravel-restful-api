<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Post;

/**
 * @group Post Management
 * 
 * APIs for managing Posts
 */
class PostController extends Controller
{
	/**
	 * Get all Posts
	 * 
	 * This endpoint lets you get all Posts
	 *
	 * @todo Add Transformer
	 * @param Request $request
	 * @uses App\Models\Post $posts
	 * @return JsonResponse
	 */
	public function all(Request $request): JsonResponse
	{
		$posts = Post::paginate();
		return response()->success($posts);
	}

	/**
	 * Store new Post
	 * 
	 * This endpoint lets you store a new Post
	 * 
	 * @authenticated
	 * @param Request $request
	 * @uses App\Models\Post $post
	 * @return JsonResponse
	 */
	public function store(Request $request): JsonResponse
	{
		$post = new Post;
		$post->title = $request->title;
		$post->content = $request->content;
		$post->excerpt = $request->excerpt;
		$post->status = $request->status;
		$post->post_type = $request->post_type;
		$post->created_by = Auth::user()->id;
		$post->parent_id = $request->parent_id;
		if ($post->save()) {
			return response()->success('post created');
		} else {
			return response()->error('failed to create post');
		}
	}

	/**
	 * Get a Post
	 * 
	 * This endpoint lets you get a Post
	 *
	 * @todo 2nd parameter should auto resolve into a Post model instance
	 * @param Request $request
	 * @param String $slug the slug of the post we want
	 * @return JsonResponse
	 */
	public function get(Request $request, String $slug): JsonResponse
	{
		$post = Post::where('slug', $slug)->first();
		if ($post) {
			return response()->success($post);
		} else {
			return response()->error('Post not found', 404);
		}
	}

	/**
	 * Update a Post
	 * 
	 * This endpoint lets you update a Post
	 *
	 * @authenticated
	 * @todo 2nd parameter should auto resolve into an Post model instance
	 * @param Request $request
	 * @param String $slug the slug of the Post we want to update
	 * @return JsonResponse
	 */
	public function update(Request $request, String $slug): JsonResponse
	{
		$post = Post::where('slug', $slug)->first();
		if ($post) {
			$post->title = $request->title;
			$post->content = $request->content;
			$post->excerpt = $request->excerpt;
			$post->status = $request->status;
			$post->post_type = $request->post_type;
			$post->updated_by = Auth::user()->id;
			$post->parent_id = $request->parent_id;
			if ($post->save()) {
				return response()->success('success');
			} else {
				return response()->error('failed to update post', 406);
			}
		} else {
			return response()->error('Post not found', 404);
		}
	}

	/**
	 * Delete a Post
	 * 
	 * This endpoint lets you delete a Post
	 *
	 * @authenticated
	 * @todo 2nd parameter should auto resolve into a Post model instance
	 * @todo by default we should only soft delete
	 * @todo add bodyParam `force` to add ability to specify if we want to hard delete.
	 * @param Request $request
	 * @param String $slug the slug of the Post we want to delete
	 * @return JsonResponse
	 */
	public function delete(Request $request, String $slug): JsonResponse
	{
		$post = Post::where('slug', $slug)->first();
		if ($post) {
			if ($post->delete()) {
				return response()->success('Post deleted successfully');
			} else {
				return response()->error('Failed to delete post', 406);
			}
		} else {
			return response()->error('Post not found', 404);
		}
	}
}
