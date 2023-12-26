<?php

namespace App\Services\Admin;

use App\Mail\MessageMail;
use App\Models\Request as ModelRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AdminRequestService
{
	public function getDateRange($data): array
	{
		$dateRange = [
			'form' => [],
			'db' => [],
		];

		if (isset($data['date_range'])) {
			$dateRaw = explode('-', $data['date_range']);

			if (is_array($dateRaw) && count($dateRaw) == 2) {
				$date1 = new Carbon(trim($dateRaw[0]));
				$date2 = new Carbon(trim($dateRaw[1]));

				$dateRange['form'][0] = $date1->format('d.m.Y');
				$dateRange['form'][1] = $date2->format('d.m.Y');
				$dateRange['db'][0] = $date1->format('Y-m-d');
				$dateRange['db'][1] = $date2->addDay(1)->format('Y-m-d');
			} else {
				$date1 = new Carbon();
				$date1 = $date1->firstOfMonth();
				$date2 = new Carbon();
				$date2 = $date2->lastOfMonth();

				$dateRange['form'][0] = $date1->format('d.m.Y');
				$dateRange['form'][1] = $date2->format('d.m.Y');
				$dateRange['db'][0] = $date1->format('Y-m-d');
				$dateRange['db'][1] = $date2->addDay(1)->format('Y-m-d');
			}
		} else {
			$date1 = new Carbon();
			$date1 = $date1->firstOfMonth();
			$date2 = new Carbon();
			$date2 = $date2->lastOfMonth();

			$dateRange['form'][0] = $date1->format('d.m.Y');
			$dateRange['form'][1] = $date2->format('d.m.Y');
			$dateRange['db'][0] = $date1->format('Y-m-d');
			$dateRange['db'][1] = $date2->addDay(1)->format('Y-m-d');
		}

		return $dateRange;
	}

	public function requests($data, $dateRange): LengthAwarePaginator
	{
		if (isset($data['status']) && $data['status'] != '0') {
			$modelsRequest =  ModelRequest::query()->latest('created_at')->where('status', '=', $data['status'])->whereBetween('updated_at', [
				$dateRange['db'][0],
				$dateRange['db'][1]
			])->paginate(10);
		} else {
			$modelsRequest =  ModelRequest::query()->latest('created_at')->whereBetween('updated_at', [
				$dateRange['db'][0],
				$dateRange['db'][1]
			])->paginate(10);
		}

		return $modelsRequest;
	}

	public function requestUpdate(ModelRequest $modelRequest, array $data)
	{
		if (!$modelRequest->update($data)) {
			throw ValidationException::withMessages(['error' => 'Ошибка сохранения данных']);
		}

		// Отправка писма (письмо будет добавленно в очередь)
		// Нужно заполнить данные доступа к почтовому сервису в .env
		// После, выполнить команду php artisan queue:work (запуск обработки очередей)
		Mail::to($modelRequest->email)->send(new MessageMail($modelRequest->id, $data['comment']));
	}
}
