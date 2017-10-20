<div class="grid simple ">
	<div class="grid-title no-border">
		<h4> <span class="semi-bold"></span></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#grid-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="grid-body table-responsive no-border ">
		<br>
		{{-- <h3>Stripped  <span class="semi-bold">Table</span></h3> --}}
		{{-- <p>They (allegedly) aid usability in reading tabular data by offering the user a coloured means of separating and differentiating rows from one another. Simply add the class<code>.table-striped</code> --}}
		{{-- </p> --}}
		<div class="pull-left">
			{!! $grid->renderHeaderTool() !!}
		</div>
		<div class="pull-right">
			{!! $grid->renderFilter() !!}
			{!! $grid->renderExportButton() !!}
			{!! $grid->renderCreateButton() !!}
		</div>

		<br>
		 {{-- no-more-tables --}}
		<table class="table table-hover table-striped">
			<thead class="cf">
				<tr>
					@foreach($grid->columns() as $column)
					<th>{{ $column->getLabel() }}{!! $column->sorter() !!}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($grid->rows() as $row)
				<tr {!! $row->getRowAttributes() !!}>
					@foreach($grid->columnNames as $name)
					<td {!! $row->getColumnAttributes($name) !!}>
						{!! $row->column($name) !!}
					</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
		{!! $grid->paginator() !!}
	</div>
</div>
