<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;

class AuthController extends Passport
{
    /**
     * Sign In.
     *`
     * @OA\Get(
     *     path="/auth/signin",
     *     summary="Sign In",
     *     tags={"Auth"},
     *     description="Sign In",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function signin(Request $request)
    {
    }

    /**
     * Sign Out.
     *`
     * @OA\Get(
     *     path="/auth/signout",
     *     summary="Sign Out",
     *     tags={"Auth"},
     *     description="Sign Out",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     * @OA\Post(
     *     path="/auth/signout",
     *     summary="Sign Out",
     *     tags={"Auth"},
     *     description="Sign Out",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     */
    public function signout(Request $request)
    {
    }

    /**
     * Sign Up.
     *`
     * @OA\Post(
     *     path="/auth/signup",
     *     summary="Sign Up",
     *     tags={"Auth"},
     *     description="Sign Up",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     */
    public function signup(Request $request)
    {
    }

    /**
     * Refresh token.
     *`
     * @OA\Get(
     *     path="/auth/refresh",
     *     summary="Refresh token",
     *     tags={"Auth"},
     *     description="Refresh token",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     */
    public function refresh(Request $request)
    {
    }
}
