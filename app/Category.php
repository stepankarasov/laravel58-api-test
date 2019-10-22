<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 *  description="Categories",
 *  title="Categories Schema",
 *  required={
 *     "id",
 *     "name",
 *     "description",
 *     "parentId"
 *  },
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Category ID"
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
 *      property="parentId",
 *      type="integer",
 *      description="Parent ID"
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
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parentId',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parentId');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parentId');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
