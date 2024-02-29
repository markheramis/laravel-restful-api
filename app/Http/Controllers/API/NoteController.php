<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

use App\Http\Requests\Note\ShowNoteRequest;
use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Http\Requests\Note\DeleteNoteRequest;

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
     * Store User Note
     * 
     * This endpoint allows you to store a new user note
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

    /**
     * Update User Note
     * 
     * This endpoint allows you to update a new user note
     *
     * @authenticated
     * @param UpdateNoteRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(UpdateNoteRequest $request, Note $note, int $id){
        
        $note = Note::find($id);
        $note->user_id = $request->userid;
        $note->title = $request->title;
        $note->badge = $request->badge;
        $note->body = $request->body;      
        $note->save();
        return response()->success($note);
    }

    /**
     * Delete User Note
     * 
     * This endpoint allows you to delete a new user note
     *
     * @authenticated
     * @param DesleteNoteRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function destroy(DeleteNoteRequest $request, Note $note, int $id){
        $note->delete();
        return response()->success('Note Deleted');
    }


}
