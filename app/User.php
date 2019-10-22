<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 *
 * @OA\Schema(
 *  description="Users",
 *  title="Users Schema",
 *  required={
 *     "id",
 *     "name",
 *     "email"
 *  },
 *  @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="User ID"
 *  ),
 *  @OA\Property(
 *      property="name",
 *      type="string",
 *      description="Name"
 *  ),
 *  @OA\Property(
 *      property="email",
 *      type="string",
 *      description="Email"
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
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
