<div class="btn-group pull-right m-l-10">
	<button href="" class="btn btn-mini btn-primary" data-toggle="modal" data-target="#filter-modal">
		<i class="fa fa-search"></i>
		搜索
	</button>
	<button class="btn btn-mini btn-info"><i class="fa fa-undo"></i> 重置</button>
</div>
<!-- Modal -->
<div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<br>
				<i class="fa fa-search fa-4x"></i>
				<h4 id="myModalLabel" class="semi-bold">{{ trans('gayly.filter') }}</h4>
				<br>
			</div>
			<form action="{!! $action !!}" method="get">
				<div class="modal-body">
					<div class="row form-row">
						<div class="col-md-8 col-md-offset-2">
							@foreach($filters as $filter)
	                            <div class="form-group">
	                                {!! $filter->render() !!}
	                            </div>
	                        @endforeach
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-default">{{ trans('gayly.reset') }}</button>
					<button type="submit" class="btn btn-primary" >{{ trans('gayly.submit') }}</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Modal -->
