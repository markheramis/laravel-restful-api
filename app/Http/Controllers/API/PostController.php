<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function all(Request $request) {
    	$posts = Post::paginate();
    	return response()->json([
    		'status' => 'success',
    		'data' => $posts
    	], 200);
    }

    public function store(Request $request) {
    	$post = new Post;
    	$post->title = $request->title;
    	$post->content = $request->content;
    	$post->excerpt = $request->excerpt;
    	$post->status = $request->status;
    	$post->post_type = $request->post_type;
    	$post->created_by = Auth::user()->id;
    	$post->parent_id = $request->parent_id;
    	if($post->save()) {
    		return response()->json(['status' => 'success'], 200);
    	} else {
    		return response()->json(['status' => 'error'], 406);
    	}
    }

    public function get(Request $request, String $slug) {
    	$post = Post::where('slug', $slug)->first();
    	if ($post) {
    		return response()->json([
    			'status' => 'success',
    			'data' => $post
    		], 200);
    	} else {
    		return response()->json(['status' => 'error'], 404);
    	}
    }

    public function update(Request $request, String $slug) {
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
    			return response()->json(['status' => 'success'], 200);
    		} else {
    			return response()->json(['status' => 'error'], 406);
    		}
    	} else {
    		return response()->json(['status' => 'error'], 404);
    	}
    }

    public function delete(Request $request, String $slug) {
    	$post = Post::where('slug', $slug)->first();
    	if ($post) {
    		if ($post->delete()) {
    			return response()->json(['status' => 'success'], 200);
    		} else {
    			return response()->json(['status' => 'error'], 406);
    		}
    	} else {
    		return response()->json(['status' => 'error'], 404);
    	}
    }
}
