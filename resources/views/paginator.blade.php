<div class="pull-right">
	<div class="btn-group">
		<!-- Previous Page Link -->
		@if ($paginator->onFirstPage())
		<a class="btn btn-white btn-mini disabled"><i class="fa fa-chevron-left"></i></a>
		@else
		<a class="btn btn-white btn-mini" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-chevron-left"></i></a>
		@endif

		<!-- Pagination Elements -->
		@foreach ($elements as $element)
		<!-- "Three Dots" Separator -->
		@if (is_string($element))
		<a class="btn btn-white btn-mini disabled">{{ $element }}</a>
		@endif

		<!-- Array Of Links -->
		@if (is_array($element))
		@foreach ($element as $page => $url)
		@if ($page == $paginator->currentPage())
		<a class="btn btn-white btn-mini active">{{ $page }}</a>
		@else
		<a class="btn btn-white btn-mini"href="{{ $url }}">{{ $page }}</a>
		@endif
		@endforeach
		@endif
		@endforeach

		<!-- Next Page Link -->
	    @if ($paginator->hasMorePages())
		<a class="btn btn-white btn-mini" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-chevron-right"></i> </a>
	    @else
		<a class="btn btn-white btn-mini disabled"><i class="fa fa-chevron-right"></i> </a>
	    @endif
  	</div>
</div>
