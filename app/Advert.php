<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 *  description="Adverts",
 *  title="Adverts Schema",
 *  required={
 *     "id",
 *     "name",
 *     "description",
 *     "authorId",
 *     "categoryId"
 *  },
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Advert ID"
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string",
 *      description="Name|Title"
 *  ),
 *  @OA\Property(
 *      property="description",
 *      type="string",
 *      description="Description"
 *  ),
 *  @OA\Property(
 *      property="authorId",
 *      type="integer",
 *      description="Author ID"
 *  ),
 *  @OA\Property(
 *      property="categoryId",
 *      type="integer",
 *      description="Category ID"
 *  ),
 *  @OA\Property(
 *      property="status",
 *      type="integer",
 *      description="Status (0 - not active, 1 - active)"
 *  ),
 *  @OA\Property(
 *      property="created_at",
 *      type="integer",
 *      description="Created at"
 *  ),
 *  @OA\Property(
 *      property="updated_at",
 *      type="integer",
 *      description="Updated at"
 *  )
 * )
 */
class Advert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'authorId',
        'categoryId',
        'status',
    ];
}
