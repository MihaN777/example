<?php

namespace App\Models;

use App\Notifications\SendResetWithQueueNotification;
use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable /* implements MustVerifyEmail */
{
	use HasApiTokens, HasFactory, Notifiable;

	const ROLE_USER = 0;
	const ROLE_ADMIN = 1;

	protected $table = 'users';
	protected $guarded = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'role',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'role',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public static function getRoles()
	{
		return [
			self::ROLE_USER => 'Пользователь',
			self::ROLE_ADMIN => 'Админ',
		];
	}

	// Отправить кастомных шаблонов писем через очередь

	// public function sendEmailVerificationNotification()
	// {
	// 	$this->notify(new SendVerifyWithQueueNotification());
	// }

	public function sendPasswordResetNotification($token)
	{
		$this->notify(new SendResetWithQueueNotification($token));
	}
}
