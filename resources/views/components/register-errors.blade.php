@if ($errors->any())

<div class="_register-errors" data-register-errors>
	<ul>

		@foreach ($errors->all() as $message)
		<li>{{ $message }}</li>
		@endforeach

	</ul>
</div>

@endif