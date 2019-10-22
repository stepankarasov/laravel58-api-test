<?php

namespace App\Http\Controllers\Api\v1;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Http\Resources\CommentCollection;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/comment",
     *     summary="Get list of comments",
     *     tags={"Comments"},
     *     description="Get list of comments",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Comment")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     )
     * )
     *
     * @return CommentCollection
     */
    public function index()
    {
        return new CommentCollection(Comment::with('childrenRecursive')->whereNull('parentId')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/comment",
     *     summary="Create new comment",
     *     tags={"Comments"},
     *     description="Create new comment",
     *     @OA\RequestBody(
     *         description="Comment object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comment"),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Comment"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Comment is not found",
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
     * @param StoreComment $request
     * @return Response
     */
    public function store(StoreComment $request)
    {
        $comment = Comment::create($request->all());

        return response()->json($comment, 201)
            ->header('Content-Location', route('comment.store') . "/{$comment->id}");
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/comment/{id}",
     *     summary="Get comment by id",
     *     tags={"Comments"},
     *     description="Get comment by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Comment ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Comment"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Comment is not found",
     *     )
     * )
     *
     * @param Comment $comment
     * @return Comment
     */
    public function show(Comment $comment)
    {

        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Post(
     *     path="/comment/{id}",
     *     summary="Update comment by id",
     *     tags={"Comments"},
     *     description="Update comment by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Comment ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Comment object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comment"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Comment"),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Comment is not found",
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
     * @param StoreComment $request
     * @param Comment      $comment
     * @return Response
     */
    public function update(StoreComment $request, Comment $comment)
    {
        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/comment/{id}",
     *     summary="Delete comment by id",
     *     tags={"Comments"},
     *     description="Delete comment by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Comment ID",
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
     *         description="Comment is not found",
     *     ),
     *     security={
     *         {"passport": {}}
     *     }
     * )
     *
     * @param Comment $comment
     * @return Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        if (Auth::guard('api')->id() != $comment->authorId) {
            return response()->json(null, 403);
        }
        $comment->delete();

        return response()->json(null, 204);
    }
}
