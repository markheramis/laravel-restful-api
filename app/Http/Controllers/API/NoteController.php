<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

use App\Http\Requests\Note\ShowNoteRequest;

/**
 * @group  User Profile Management
 *
 * APIs for managnign Users Meta Data
 */
class NoteController extends Controller
{
      /**
     * Show Notes
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


}
