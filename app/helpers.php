<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('validate')) {
	function validate(array $data = [], array $rules = [], array $messages = [], array $attributes = []): array
	{
		return validator($data, $rules, $messages, $attributes)->validate();
	}
}

if (!function_exists('transaction')) {
	function transaction(Closure $callback, int $attempts = 1): mixed
	{
		// Если транзакция уже открыта
		// то просто вызываем колбэк
		if (DB::transactionLevel() > 0) {
			return $callback();
		}

		return DB::transaction($callback, $attempts);
	}
}

if (!function_exists('makeUniqueFolder')) {
	function makeUniqueFolder(string $disk, string $path, string $prefix, int $moreRandomChars = 10): string|bool
	{
		$result = false;
		$uniqueFolder = '';
		$pathFolder = '';

		for ($i = 0; $i < 500; ++$i) {
			$uniqueFolder = uniqid($prefix) . ($moreRandomChars > 0 ? '_' . Str::random($moreRandomChars) : '');
			$pathFolder = trim($path, " /\\") . '/' . $uniqueFolder;

			if (!Storage::disk($disk)->exists($pathFolder)) {
				$result = true;
				break;
			}
		}

		return $result && Storage::disk($disk)->makeDirectory($pathFolder) ? $uniqueFolder : false;
	}
}
