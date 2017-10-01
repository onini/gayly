<div class="grid simple ">
	<div class="grid-title no-border">
		<h4>{{ $title or '列表' }} <span class="semi-bold"></span></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#grid-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="grid-body no-border">
		{{-- <h3>Stripped  <span class="semi-bold">Table</span></h3> --}}
		{{-- <p>They (allegedly) aid usability in reading tabular data by offering the user a coloured means of separating and differentiating rows from one another. Simply add the class<code>.table-striped</code> --}}
		</p>
		<button type="button" class="btn btn-info btn-xs btn-mini"><i class="fa fa-refresh"></i> 刷新</button>

		<div class="pull-right">
			{!! $grid->renderFilter() !!}
			<div class="btn-group pull-right m-l-10">
			    <button href="" class="btn btn-mini btn-primary" data-toggle="modal" data-target="#filter-modal">
					<i class="fa fa-filter"></i>
					Filter
				</button>
			    <button class="btn btn-mini btn-info"><i class="fa fa-undo"></i> Reset</button>
			</div>
			<div class="btn-group pull-right m-l-10">
				<button class="btn btn-mini btn-success btn-demo-space"><i class="fa fa-download"></i> 导出</button>
				<button class="btn btn-mini btn-success dropdown-toggle btn-demo-space" data-toggle="dropdown"> <span class="caret"></span> </button>
				<ul class="dropdown-menu">
					<li><a href="#">Excel</a></li>
					<li class="divider"></li>
				</ul>
			</div>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-xs btn-mini"><i class="fa fa-user"></i> 添加</button>
			</div>
		</div>

		<br>
		<table class="table table-striped table-flip-scroll cf">
			<thead class="cf">
				<tr>
					<th width="50">
						<div class="checkbox check-default ">
							<input id="checkbox1" type="checkbox" value="1" class="checkall">
							<label for="checkbox1"></label>
						</div>
					</th>
					@foreach($grid->columns() as $column)
					<th>{{ $column->getLabel() }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($grid->rows() as $row)
				<tr {!! $row->getRowAttributes() !!}>
					<td>
						<div class="checkbox check-default">
							<input id="checkbox2" type="checkbox" value="1">
							<label for="checkbox2"></label>
						</div>
					</td>
					@foreach($grid->columnNames as $name)
					<td {!! $row->getColumnAttributes($name) !!}> {!! $row->column($name) !!}
					</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
