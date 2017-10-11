
<div class="grid simple horizontal green">
	<div class="grid-title no-border">
		<h4>{{ $form->title() }} <span class="semi-bold"></span></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="#grid-config" data-toggle="modal" class="config"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="grid-body no-border">
        <div class="pull-right">
            {!! $form->renderHeaderTool() !!}
        </div>
        @if($form->hasHorizontal())
            {!! $form->open(['class' => "form-horizontal"]) !!}
        @else
            {!! $form->open() !!}
        @endif
		<br>
            @if(!$tabObj->isEmpty())
                @include('gayly::form.tab', compact('tabObj'))
            @else
                <div class="fields-group">

                    @if($form->hasRows())
                        @foreach($form->getRows() as $row)
                            {!! $row->render() !!}
                        @endforeach
                    @else
                        @foreach($form->fields() as $field)
                            {!! $field->render() !!}
                        @endforeach
                    @endif


                </div>
            @endif

            @if( ! $form->isMode(\Onini\Gayly\Support\Form\Builder::MODE_VIEW)  || ! $form->option('enableSubmit'))
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @endif
            <div class="{{$width['label']}}">

            </div>
			<div class="clearfix">

			</div>
            <div class="{{$width['field']}}">

                {!! $form->submitButton() !!}

                {!! $form->resetButton() !!}

            </div>

        @foreach($form->getHiddenFields() as $hiddenField)
            {!! $hiddenField->render() !!}
        @endforeach
        {!! $form->close() !!}

	</div>
</div>
