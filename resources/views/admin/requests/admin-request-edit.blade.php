@extends('admin.layouts.admin-layout')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Ответ на заявку</h1>
				{{-- <h2 class="mt-4" style="font-size: 14px">
					* обязательные для заполнения поля
				</h2> --}}
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.requests') }}">Заявки</a></li>
					<li class="breadcrumb-item active">Ответ на заявку</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">

				<x-errors />

				<form action="{{ route('admin.request.update', $modelRequest->id) }}" method="POST">
					@csrf
					@method('patch')

					<div class="form-group" style="font-size: 18px; font-weight: 700;">
						Имя: {{ $modelRequest->name }}
					</div>

					<div class="form-group" style="font-size: 18px; font-weight: 700;">
						Email: {{ $modelRequest->email }}
					</div>

					<div class="form-group">
						<label for="exampleTextareaBorder">Сообщение пользователя</label>
						<textarea class="form-control" cols="40" rows="10" placeholder="Сообщение пользователя"
							id="exampleTextareaBorder" readonly>{{ $modelRequest->message }}</textarea>
					</div>

					<div class="form-group">
						<label for="exampleTextareaBorder">Ответ на заявку</label>
						<textarea name="comment" class="form-control" cols="40" rows="10" placeholder="Ответ на заявку"
							id="exampleTextareaBorder">{{ $modelRequest->comment ?? old('comment') }}</textarea>
					</div>

					<div class="form-group">
						<label for="exampleSelectBorder">Статус</label>
						<select name="status" class="custom-select form-control" id="exampleSelectBorder">
							@foreach ($statuses as $key => $status)

							@if ($modelRequest->status == $key)
							<option selected value="{{ $key }}">{{ $status }}</option>
							@continue
							@endif
							<option value="{{ $key }}">{{ $status }}</option>

							@endforeach
						</select>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Редактировать">
					</div>
				</form>

			</div>
		</div>

		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection