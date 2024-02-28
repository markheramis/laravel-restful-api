<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

use App\Http\Requests\Note\ShowNoteRequest;
use App\Http\Requests\Note\StoreNoteRequest;

/**
 * @group  User Profile Management
 *
 * APIs for managnign Users Meta Data
 */
class NoteController extends Controller
{
      /**
     * Show User Notes
     * 
     * This endpoint allows you to show a user note that matches the user ID
     *
     * @authenticated
     * @param ShowNoteRequest $request
     * @param integer $id
     * @return void
     */

     public function show(ShowNoteRequest $request, int $id) {
        $note = Note::find($id);
        return response()->success($note);
    }

     /**
     * Store User Notes
     * 
     * This endpoint allows you to store a new user notes
     *
     * @authenticated
     * @param StoreNoteRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function store(StoreNoteRequest $request) {
        $note = new Note;
        $note->user_id = $request->userid;
        $note->title = $request->title;
        $note->badge = $request->badge;
        $note->body = $request->body;      
        $note->save();
        return response()->success($note);
    }

}
