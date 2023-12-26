@extends('layouts.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/_normalize.css') }}" />
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
{{-- styles --}}
@endsection

@section('title', 'Example')

@section('content')
<div class="content">

	{{-- MAIN-IMG --}}
	<div class="main-img">
		<img src="{{ asset('img/contents/index/main_img.png') }}" class="main-img__bg" alt="Главное изображение" />
	</div>

	<main class="container">

		<div class="class__row">
			<div class="class__col">

			</div>
		</div>

	</main>
</div>
{{-- content --}}
@endsection

@section('scripts')
<script src="{{ asset('js/main.js') }}"></script>
{{-- scripts --}}
@endsection