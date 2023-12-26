@if ($paginator->hasPages())
<nav>
	<ul class="pagination">
		{{-- Previous Page Link --}}
		@if ($paginator->onFirstPage())
		<li class="page-item disabled">
			<span class="page-link">1</span>
		</li>
		<li class="page-item disabled">
			<span class="page-link">&lsaquo;</span>
		</li>
		@else
		<li class="page-item">
			<a class="page-link" href="{{ $paginator->url(1) }}">1</a>
		</li>
		<li class="page-item">
			<a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
		</li>
		@endif

		@php
		$length = 9;
		$offset = $paginator->currentPage() - 5;

		if ($paginator->currentPage() <= 4) { $offset=0; } elseif ($paginator->currentPage() >= $paginator->lastPage() - 4)
			{ $offset = $length * -1 ; }

			@endphp

			@dump($elements)

			{{-- Pagination Elements --}}
			@foreach ($elements as $element)

			@dump($element)

			{{-- Array Of Links --}}
			@if (is_array($element))
			@foreach (array_slice($element, $offset, $length, true) as $page => $url)

			@if ($page == $paginator->currentPage())
			<li class="page-item active">
				<span class="page-link">{{ $page }}</span>
			</li>
			@else
			<li class="page-item">
				<a class="page-link" href="{{ $url }}">{{ $page }}</a>
			</li>
			@endif

			@endforeach
			@endif

			{{-- End Pagination Elements --}}
			@endforeach

			{{-- Next Page Link --}}
			@if ($paginator->hasMorePages())
			<li class="page-item">
				<a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
			</li>
			@else
			<li class="page-item disabled">
				<span class="page-link">&rsaquo;</span>
			</li>
			<li class="page-item disabled">
				<span class="page-link">{{ $paginator->lastPage() }}</span>
			</li>
			@endif
	</ul>
</nav>
@endif