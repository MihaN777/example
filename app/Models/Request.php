<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
	use HasFactory;

	const STATUS_ACTIVE = 'Active';
	const STATUS_RESOLVED = 'Resolved';

	protected $table = 'requests';
	protected $guarded = false;

	public static function getStatuses()
	{
		return [
			self::STATUS_ACTIVE => 'Активная',
			self::STATUS_RESOLVED => 'Завершена',
		];
	}
}
