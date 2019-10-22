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
 *     "message",
 *     "authorId",
 *     "advertId"
 *  },
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Advert ID"
 *  ),
 *  @OA\Property(
 *      property="message",
 *      type="string",
 *      description="Message"
 *  ),
 *  @OA\Property(
 *      property="authorId",
 *      type="integer",
 *      description="Author ID"
 *  ),
 *  @OA\Property(
 *      property="advertId",
 *      type="integer",
 *      description="Advert ID"
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
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parentId',
        'message',
        'authorId',
        'advertId',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parentId');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parentId');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
