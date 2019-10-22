<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvert;
use App\Http\Resources\AdvertCollection;
use Illuminate\Http\Request;
use App\Advert;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *`
     * @OA\Get(
     *     path="/advert",
     *     summary="Get list of adverts",
     *     tags={"Adverts"},
     *     description="Get list of adverts",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Advert")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     )
     * )
     *
     * @return AdvertCollection
     */
    public function index()
    {
        return new AdvertCollection(Advert::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/advert",
     *     summary="Create new advert",
     *     tags={"Adverts"},
     *     description="Create new advert",
     *     @OA\RequestBody(
     *         description="Advert object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Advert"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Advert"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Advert is not found",
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
     * @param StoreAdvert $request
     * @return Response
     */
    public function store(StoreAdvert $request)
    {
        //$validated = $request->validated();

        $advert = Advert::create($request->all());

        return response()->json($advert, 201)
            ->header('Content-Location', route('advert.store') . "/{$advert->id}");
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/advert/{id}",
     *     summary="Get advert by id",
     *     tags={"Adverts"},
     *     description="Get advert by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Advert ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Advert"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Advert is not found",
     *     )
     * )
     *
     * @param Advert $advert
     * @return Advert
     */
    public function show(Advert $advert)
    {

        return $advert;
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Post(
     *     path="/advert/{id}",
     *     summary="Update advert by id",
     *     tags={"Adverts"},
     *     description="Update advert by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Advert ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Advert object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Advert"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Advert"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Advert is not found",
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
     * @param Request $request
     * @param Advert  $advert
     * @return Response
     */
    public function update(Request $request, Advert $advert)
    {
        $advert->update($request->all());

        return response()->json($advert, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/advert/{id}",
     *     summary="Delete advert by id",
     *     tags={"Adverts"},
     *     description="Delete advert by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Advert ID",
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
     *         response="403",
     *         description="Access denied",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Advert is not found",
     *     ),
     *     security={
     *         {"passport": {}}
     *     }
     * )
     *
     * @param Advert $advert
     * @return Response
     * @throws \Exception
     */
    public function destroy(Advert $advert)
    {
        if (Auth::guard('api')->id() != $advert->authorId) {
            return response()->json(null, 403);
        }
        $advert->delete();

        return response()->json(null, 204);
    }
}
