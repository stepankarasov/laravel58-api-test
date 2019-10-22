<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\Validation\Validator;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Test Rest API",
 *     ),
 *     @OA\Server(
 *         description="OpenApi host",
 *         url="http://127.0.0.1:8000/api/v1/"
 *     )
 * )
 * @OA\Tag(
 *     name="Auth",
 *     description="Auth endpoints",
 * )
 * @OA\Tag(
 *     name="Adverts",
 *     description="Adverts endpoints",
 * )
 * @OA\Tag(
 *     name="Categories",
 *     description="Categories endpoints",
 * )
 * @OA\Tag(
 *     name="Comments",
 *     description="Comments endpoints",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * {@inheritdoc}
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
