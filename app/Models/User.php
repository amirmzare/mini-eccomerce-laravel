<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\UserStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string $password
 * @property string $email
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';
	public static $snakeAttributes = false;

	protected $casts = [
		'status' => UserStatus::class
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'mobile',
		'password',
		'email',
		'status'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
