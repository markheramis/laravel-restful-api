<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Transformers\CategoryTransformer;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryShowRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\Category\CategoryDestroyRequest;
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
    public function index(CategoryIndexRequest $request): JsonResponse
    {
        $paginator = Category::paginate();
        $category = $paginator->getCollection();

        $response = fractal()
            ->collection($category)
            ->transformWith(new CategoryTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json($response);
    }

    /**
     * Store a Category
     *
     * This endpoint lets you store a new Category
     *
     * @authenticated
     * @param CategoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        $response = fractal($category, new CategoryTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Show a Category
     *
     * This endpoint lets you get a Category
     *
     * @authenticated
     * @param CategoryGetRequest $request
     * @param App\Models\Category $category auto resolved instance of Eloquent Category
     * @uses App\Transformers\CategoryTransformer CategoryTransformer
     * @return JsonResponse
     */
    public function show(CategoryShowRequest $request, Category $category): JsonResponse
    {
        $response = fractal($category, new CategoryTransformer())->toArray();
        return response()->success($response);
    }


    /**
     * Update a Category
     *
     * This endpoint lets you update a single Category
     *
     * @authenticated
     * @param RoleUpdateReqeust $request
     * @param App\Models\Role $role auto resolved instance of Eloquent Role
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse
    {
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->update();
        $response = fractal($category, new CategoryTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Delete a Category
     *
     * This endpoint lets you delete a single Category
     *
     * @authenticated
     * @param CategoryDeleteRequest $request
     * @param App\Models\Category $category auto resolved instance of Eloquent Role
     * @return JsonResponse
     */
    public function destroy(CategoryDestroyRequest $request, Category $category): JsonResponse
    {
        $category->delete();
        return response()->success('Category deleted successfully');
    }
}
