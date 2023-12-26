<?php

namespace App\Jobs;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StoreUserJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $data;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$password = $this->data['password'];
		$this->data['password'] = Hash::make($this->data['password']);
		$user = User::firstOrCreate(['email' => $this->data['email']], $this->data);

		// Отправка писма с логином и паролем
		Mail::to($this->data['email'])->send(new PasswordMail($this->data['email'], $password));

		// Отправка письма подтверждения email
		event(new Registered($user));
	}

	// Добавить в очередь (в другом класе)
	// StoreUserJob::dispatch($data);
}
