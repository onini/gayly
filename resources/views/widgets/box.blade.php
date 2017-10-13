<div class="grid simple vertical green" {!! $attributes !!}>
	@if ($useHeader)
		<div class="grid-title no-border">
			<h4>{{ $title }} <span class="semi-bold"></span></h4>
	        <div class="pull-right">
				@foreach($tools as $tool) {!! $tool !!} @endforeach
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="#grid-config" data-toggle="modal" class="config"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
	@endif
	<div class="grid-body no-border">
		{!! $content !!}
	</div>
</div>
