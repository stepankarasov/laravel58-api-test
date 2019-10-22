<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/category",
     *     summary="Get list of category",
     *     tags={"Categories"},
     *     description="Get list of category",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Category")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     )
     * )
     *
     * @return CategoryCollection
     */
    public function index()
    {
        return new CategoryCollection(Category::with('childrenRecursive')->whereNull('parentId')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/category",
     *     summary="Create new category",
     *     tags={"Categories"},
     *     description="Create new category",
     *     @OA\RequestBody(
     *         description="Category object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Category"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category is not found",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation Errors",
     *     ),
     *     security={
     *         {"passport": {}}
     *     }
     * )
     *
     * @param StoreCategoryt $request
     * @return Response
     */
    public function store(StoreCategoryt $request)
    {
        $category = Category::create($request->all());

        return response()->json($category, 201)
            ->header('Content-Location', route('category.store') . "/{$category->id}");
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/category/{id}",
     *     summary="Get category by id",
     *     tags={"Categories"},
     *     description="Get category by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Category ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Category"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category is not found",
     *     )
     * )
     *
     * @param Category $category
     * @return Category
     */
    public function show(Category $category)
    {

        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Post(
     *     path="/category/{id}",
     *     summary="Update category by id",
     *     tags={"Categories"},
     *     description="Update category by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Category ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Category object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Category"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category is not found",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation Errors",
     *     ),
     *     security={
     *         {"passport": {}}
     *     }
     * )
     *
     * @param Request  $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/category/{id}",
     *     summary="Delete category by id",
     *     tags={"Categories"},
     *     description="Delete category by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Category ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Category is not found",
     *     ),
     *     security={
     *         {"passport": {}}
     *     }
     * )
     *
     * @param Category $category
     * @return Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
