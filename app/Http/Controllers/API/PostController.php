<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
	public function all(Request $request)
	{
		$posts = Post::paginate();
		return response()->success($posts);
	}

	public function store(Request $request)
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

	public function get(Request $request, String $slug)
	{
		$post = Post::where('slug', $slug)->first();
		if ($post) {
			return response()->success($post);
		} else {
			return response()->error('Post not found', 404);
		}
	}

	public function update(Request $request, String $slug)
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

	public function delete(Request $request, String $slug)
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
