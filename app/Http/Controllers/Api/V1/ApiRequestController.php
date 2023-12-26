<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRequestController extends Controller
{
	public function makeRequest(Request $request)
	{
		$validator = Validator::make(
			$request->only(['name', 'email', 'message']),
			[
				'name' => ['required', 'string', 'max:50'],
				'email' => ['required', 'email', 'max:100'],
				'message' => ['required', 'string', 'max:1000'],
			],
			[
				'required' => 'Поле :attribute не заполнено',
				'email' => 'Не корректный :attribute',
				'max' => 'Превышена максимальная длина поля :attribute',
			],
			[
				'name' => 'name',
				'email' => 'email',
				'message' => 'message',
			]
		);

		if ($validator->fails()) {
			return response()->json(
				[
					'status' => 'fail',
					'errors' => $validator->errors()->all()
				]
			);
		}

		$modelsRequest = ModelsRequest::create($request->only(['name', 'email', 'message']));

		if ($modelsRequest && $modelsRequest instanceof ModelsRequest) {
			return response()->json(
				[
					'status' => 'ok',
					'message' => "Добавлена заявка № {$modelsRequest->id}"
				]
			);
		} else {
			return response()->json(
				[
					'status' => 'fail',
					'errors' => 'Ошибка создания заявки'
				]
			);
		}
	}
}
