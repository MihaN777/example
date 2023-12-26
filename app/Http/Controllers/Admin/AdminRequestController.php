<?php

namespace App\Http\Controllers\Admin;

use App\Models\Request as ModelRequest;
use App\Rules\RequestStatusRule;
use Illuminate\Http\Request;

class AdminRequestController extends BaseController
{
	public function requests(Request $request)
	{
		$data = validate($request->all(), [
			'status' => ['nullable', 'string', 'min:1'],
			'date_range' => ['nullable', 'string', 'min:1'],
		]);

		$statuses = ModelRequest::getStatuses();
		$dateRange = $this->adminRequestService->getDateRange($data);
		$modelsRequest = $this->adminRequestService->requests($data, $dateRange);
		return view('admin.requests.admin-requests', compact('modelsRequest', 'statuses', 'dateRange'));
	}

	public function requestEdit(ModelRequest $modelRequest)
	{
		$statuses = ModelRequest::getStatuses();
		return view('admin.requests.admin-request-edit', compact('modelRequest', 'statuses'));
	}

	public function requestUpdate(Request $request, ModelRequest $modelRequest)
	{
		$data = validate(
			$request->all(),
			[
				'status' => ['required', 'string', new RequestStatusRule],
				'comment' => [$request->status == ModelRequest::STATUS_RESOLVED ? 'required' : 'nullable', 'string', 'max:1000'],
			],
			[
				'required' => 'Поле :attribute не заполнено',
				'max' => 'Превышена максимальная длина поля :attribute',
			],
			[
				'status' => 'Статус',
				'comment' => 'Ответ на заявку',
			]
		);

		$this->adminRequestService->requestUpdate($modelRequest, $data);
		return redirect()->route('admin.requests');
	}
}
