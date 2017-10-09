<div class="checkbox check-success pull-left m-l-15 m-t-5">
	<input id="gayly-check-all" type="checkbox" value="1" class="checkall">
	<label for="gayly-check-all"></label>
</div>
<div class="btn-group pull-left">
	<button class="btn btn-mini btn-success btn-demo-space"><i class="fa fa-location-arrow"></i> {{ trans('gayly.action') }}</button>
	<button class="btn btn-mini btn-success dropdown-toggle btn-demo-space" data-toggle="dropdown"> <span class="caret"></span> </button>
	<ul class="dropdown-menu">
		@foreach ($action as $ac)
		<li><a href="#" class="gayly-action-{{ $ac['id'] }}">{{ $ac['title'] }}</a></li>
		@endforeach
		<li class="divider"></li>
	</ul>
</div>
