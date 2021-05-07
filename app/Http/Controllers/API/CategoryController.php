<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;
use Illuminate\Http\JsonResponse;

/**
 * @group Category Management
 * 
 * APIs for managing Categories
 */
class CategoryController extends Controller
{
    /**
     * Get all Categories
     * 
     * This endpoint lets you get all the Categories
     *
     * @authenticated
     * @param CategoryAllRequest $request
     * @uses App\Models\Category $paginator
     * @uses App\Transformers\CategoryTransformer CategoryTransformer
     * @uses League\Fractal\Serializer\JsonApiSerializer JsonApiSerializer
     * @uses League\Fractal\Pagination\IlluminatePaginatorAdapter IlluminatePaginatorAdapter
     * @return JsonResponse
     */
    public function index()
    {
        $paginator = Categories::paginate();
    }
}
