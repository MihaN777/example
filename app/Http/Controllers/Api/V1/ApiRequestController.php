<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelRequest;
use App\Rules\RequestStatusRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRequestController extends Controller
{
	public function requests(Request $request)
	{
		$validator = Validator::make(
			$request->only(['status']),
			[
				'status' => ['nullable', 'string', new RequestStatusRule],
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

		return response()->json(
			[
				'status' => 'ok',
				'requests' =>
				isset($request->status) ?
					ModelRequest::query()->latest('created_at')->where('status', $request->status)->get()->toArray() :
					ModelRequest::query()->latest('created_at')->get()->toArray(),
			]
		);
	}

	public function commentRequest(Request $request)
	{
		$validator = Validator::make(
			$request->only(['id', 'comment']),
			[
				'id' => ['required', 'integer', 'min:1', 'exists:requests,id'],
				'comment' => ['required', 'string', 'max:1000'],
			],
			[
				'required' => 'Поле :attribute не заполнено',
				'integer' => 'Поле :attribute должно быть целым числом',
				'exists' => 'Идентификатор поля :attribute отсутствует',
				'min' => 'Поле :attribute не может быть меньше 1',
				'max' => 'Превышена максимальная длина поля :attribute',
			],
			[
				'id' => 'id',
				'comment' => 'comment',
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

		$modelRequest = ModelRequest::query()->where('id', $request->id)->first();

		if ($modelRequest && $modelRequest instanceof ModelRequest) {
			$modelRequest->comment = $request->comment;
			if (!$modelRequest->save()) {
				return response()->json(
					[
						'status' => 'fail',
						'errors' => 'Не удалось записать данные ответа на заявку'
					]
				);
			}

			return response()->json(
				[
					'status' => 'ok',
					'message' => 'Ответ на заявку добавлен'
				]
			);
		} else {
			return response()->json(
				[
					'status' => 'fail',
					'errors' => 'Ошибка создания ответа на заявку'
				]
			);
		}
	}

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

		$modelRequest = ModelRequest::create($request->only(['name', 'email', 'message']));

		if ($modelRequest && $modelRequest instanceof ModelRequest) {
			return response()->json(
				[
					'status' => 'ok',
					'message' => "Добавлена заявка № {$modelRequest->id}"
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
