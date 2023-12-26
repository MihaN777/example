<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name') }} | Admin</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Select2 -->
	{{--
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}"> --}}
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<!-- daterange picker -->
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
	<!-- Custom Styles -->
	<link rel="stylesheet" href="{{ asset('adminlte/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		{{-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
				width="60">
		</div> --}}

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<div class="col-12 d-flex justify-content-between">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>

				<ul class="navbar-nav">
					<li class="nav-item">
						<form action="{{ route('logout') }}" method="post">
							@csrf
							<input class="btn btn-outline-primary" type="submit" value="Выйти">
						</form>
					</li>
				</ul>
			</div>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="{{ route('home') }}" class="brand-link">
				{{-- <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
					class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
				<i class="fas fa-home ml-3 mr-2"></i>
				<span class="brand-text font-weight-light">{{ config('app.name') }}</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
						<li class="nav-item">
							<a href="{{ route('admin.requests') }}" class="nav-link">
								<i class="nav-icon fas fa-th-list"></i>
								<p>
									Заявки
								</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			@yield('content')

		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<strong>AdminLTE</strong>
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.2.0
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- overlayScrollbars -->
	<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<!-- bs-custom-file-input -->
	<script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}">
	</script>
	<!-- AdminLTE App -->
	<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
	<!-- Select2 -->
	{{-- <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script> --}}
	<!-- InputMask -->
	<script src="{{ asset('adminlte/plugins/moment/moment-with-locales.min.js') }}"></script>
	<!-- date-range-picker -->
	<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- Custom JS -->
	<script src="{{ asset('adminlte/js/custom.js') }}"></script>

	<script>
		// Initialize Select2 Elements
    // $('.select2').select2();

		$(function () {
  	bsCustomFileInput.init();
		});

		moment.locale('ru');
		//Date range picker
    $('#reservation').daterangepicker(
		{ "locale": 
			{
    		"applyLabel": "Установить",
    		"cancelLabel": "Отмена",
			}
		});
	</script>

	<style>
		.custom-file-input:lang(en)~.custom-file-label::after {
			content: "...";
		}
	</style>
</body>

</html>