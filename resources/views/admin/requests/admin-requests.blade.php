@extends('admin.layouts.admin-layout')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Заявки</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная</a></li>
					<li class="breadcrumb-item active">Заявки</li>
				</ol>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-12">

				<div class="card">

					<div class="card-header" style="display: flex; flex-direction: column; row-gap: 14px;">
						<form action="{{ route('admin.requests') }}" method="get" style="display: flex; column-gap: 20px;">
							<select name="status" class="custom-select form-control" style="height: 42px; width: 300px;">
								<option {{ ! is_null(request('status')) && request('status')=='0' ? ' selected' : '' }} value="0">
									Все заявки
								</option>

								@foreach ($statuses as $key => $status)
								<option {{ ! is_null(request('status')) && request('status')==$key ? ' selected' : '' }}
									value="{{ $key }}">
									{{ $status }}
								</option>
								@endforeach
							</select>

							<div class="input-group" style="width: 300px;">
								<div class="input-group-prepend" style="height: 42px;">
									<span class="input-group-text">
										<i class="far fa-calendar-alt"></i>
									</span>
								</div>
								<input type="text" name="date_range"
									value="{{ $dateRange['form'][0] . ' - ' .  $dateRange['form'][1] }}" class="form-control float-right"
									id="reservation" style="height: 42px;">
							</div>

							<input type="submit" class="btn btn-primary" value="Применить" style="height: 42px;" />
							<a href="{{ route('admin.requests') }}" class="btn btn-danger">Отменить</a>
						</form>
					</div>

					<div class="card-body table-responsive p-0">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Имя</th>
									<th>Email</th>
									<th>Статус</th>
									<th>Создана</th>
									<th>Обновлена</th>
									<th>Действия</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($modelsRequest as $model)
								<tr>
									<td>{{ $model->id }}</td>
									<td>{{ $model->name }}</td>
									<td>{{ $model->email }}</td>
									<td>
										@foreach ($statuses as $key => $status)

										@if ($model->status == $key)
										{{ $status }}
										@break
										@endif

										@endforeach
									</td>
									<td>{{ $model->created_at->format('d/m/Y H:i') }}</td>
									<td>{{ $model->updated_at->format('d/m/Y H:i') }}</td>
									<td>
										<a href="{{ route('admin.request.edit', $model->id) }}" class="text-success">
											<i class="fas fa-pen ml-3"></i>
										</a>
									</td>
								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>

			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<div>
			{{ $modelsRequest->links('vendor.pagination.bootstrap-4') }}
		</div>

	</div>
	<!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection