<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminRequestService;

class BaseController extends Controller
{
	public $adminRequestService;

	public function __construct(AdminRequestService $adminRequestService)
	{
		$this->adminRequestService = $adminRequestService;
	}
}
