@extends('admin.layouts.admin-layout')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-12">
				<x-errors />
				<h1 class="m-0">Главная</h1>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->

		<div class="row">
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h2>Всего: {{ $requestsCount }}</h2>

						<p>Заявки</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="{{ route('admin.requests') }}" class="small-box-footer">Подробнее <i
							class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>

		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection