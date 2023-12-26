@if ($errors->any())

<div
	style="background-color: rgb(255, 167, 167); border: 1px solid rgb(92, 92, 92); border-radius: 5px; margin-bottom: 15px;">
	<ul style="display: flex; flex-direction: column; justify-content: center; margin: 10px; padding-left: 50px;">

		@foreach ($errors->all() as $message)
		<li>{{ $message }}</li>
		@endforeach

	</ul>
</div>

@endif