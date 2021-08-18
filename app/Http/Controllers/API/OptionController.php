<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Option;
use App\Http\Requests\OptionIndexRequest;
use App\Http\Requests\OptionStoreRequest;
use App\Http\Requests\OptionGetRequest;
use App\Http\Requests\OptionUpdateRequest;
use App\Http\Requests\OptionDestroyRequest;
use Illuminate\Http\JsonResponse;

/**
 * @group Options Management
 * 
 * APIs for managing Options
 */
class OptionController extends Controller
{

    /**
     * Get All Options
     * 
     * This endpoint lets you get all autoloaded options
     * 
     * @authenticated
     *
     * @param OptionIndexRequest $request
     * @return JsonResponse
     */
    public function index(OptionIndexRequest $request): JsonResponse
    {
        $response = Option::select(['name', 'value'])->where('autoload', true)->get();
        return response()->json($response);
    }

    /**
     * Store Option
     * 
     * This endpoint lets you add a new option
     * 
     * @authenticated
     *
     * @param OptionStoreRequest $request
     * @return JsonResponse
     */
    public function store(OptionStoreRequest $request): JsonResponse
    {
        $option = new Option;
        $option->name = $request->name;
        $option->value = $request->value;
        $option->autoload = $request->autoload;

        if ($option->save())
            return response()->json($option);
    }

    /**
     * Show Option
     * 
     * This endpoint lets you get a single option that matches the name.
     * 
     * @authenticated
     *
     * @param OptionGetRequest $request
     * @param Option $option
     * @return JsonResponse
     */
    public function show(OptionGetRequest $request, Option $option): JsonResponse
    {
        return response()->json([
            'name' => $option->name,
            'value' => $option->value
        ]);
    }

    /**
     * Update Option
     * 
     * This endpoint lets you update a single option that matches the neme.
     * 
     * @authenticated
     *
     * @param OptionUpdateRequest $request
     * @param Option $option
     * @return JsonResponse
     */
    public function update(OptionUpdateRequest $request, Option $option): JsonResponse
    {
        $option->value = $request->value;
        $option->autoload = $request->autoload;
        if ($option->save())
            return response()->json($option);
    }

    /**
     * Destroy Option
     * 
     * This endpoint lets you delete a single option that matches the name.
     * 
     * @authenticated
     *
     * @param OptionDestroyRequest $request
     * @param Option $option
     * @return JsonResponse
     */
    public function destory(OptionDestroyRequest $request, Option $option): JsonResponse
    {
        if ($option->delete())
            return response()->json('success', 200);
    }
}
