<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function home()
	{
		$requestsCount = ModelsRequest::count();
		return view('admin.admin-home', compact('requestsCount'));
	}
}
