<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// implements ShouldQueue - добавляет отправку письма через очередь
class MessageMail extends Mailable /* implements ShouldQueue */
{
	use Queueable, SerializesModels;

	public $requestId;
	public $comment;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($requestId, $comment)
	{
		$this->requestId = $requestId;
		$this->comment = $comment;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->markdown('mail.message')->subject(config('app.name') . ': Ответ на заявку');
	}
}
