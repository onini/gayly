<div class="grid simple horizontal green">
	@if ($useHeader)
	<div class="grid-title no-border">
		<h4>面板 <span class="semi-bold">盒子</span></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#grid-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	@endif

	<div class="grid-body no-border">
		<div class="btn-group">
			<a class="btn btn-primary btn-mini {{ $id }}-tree-tool" data-action="expand">
                      <i class="fa fa-plus-square-o"></i>&nbsp;{{ trans('gayly.expand') }}
                  </a>
			<a class="btn btn-info btn-mini {{ $id }}-tree-tool" data-action="collapse">
                      <i class="fa fa-minus-square-o"></i>&nbsp;{{ trans('gayly.collapse') }}
                  </a>
		</div>

		<div class="btn-group">
			<a class="btn btn-success btn-mini  {{ $id }}-save"><i class="fa fa-save"></i>&nbsp;{{ trans('gayly.save') }}</a>
		</div>

		<div class="btn-group">
			<a class="btn btn-info btn-mini {{ $id }}-refresh"><i class="fa fa-refresh"></i>&nbsp;{{ trans('gayly.refresh') }}</a>
		</div>

		<div class="btn-group">
			{!! $tool !!}
		</div>

		@if($useCreate)
		<div class="btn-group pull-right">
			<a class="btn btn-success btn-mini" href="{{ $path }}/create"><i class="fa fa-save"></i>&nbsp;{{ trans('gayly.new') }}</a>
		</div>
		@endif
		<br>
		<br>
		<div class="cf nestable-lists">
			<div class="dd" id="{{ $id }}" style="width: 100%">
				<ol class="dd-list">
					@each($branchView, $items, 'branch')
				</ol>
			</div>
			<div class="clearfix"></div>
		</div>
		<br>
	</div>
</div>
<style>
    .dd {
        max-width: none;
    }
</style>
