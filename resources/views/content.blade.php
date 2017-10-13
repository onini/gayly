@extends('gayly::layouts.app')

@section('container')
<ul class="breadcrumb">
	<li>
		<p><i class="material-icons" style="font-size: 15px">location_on</i></p>
	</li>
	<li>
		<a href="#" class="active">{{ $title or config('gayly.name') }}</a>
	</li>
</ul>
<div class="page-title">
	<i class="icon-custom-left"></i>
	<h3>Basic - <span class="semi-bold">{{ $title or config('gayly.name') }}</span></h3>
</div>

{!! $content !!}
@endsection
