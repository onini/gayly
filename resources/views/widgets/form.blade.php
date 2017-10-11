<form {!! $attributes !!}>
        @foreach($fields as $field)
            {!! $field->render() !!}
        @endforeach
        {{ csrf_field() }}
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2">
            <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning pull-right">{{ trans('gayly.reset') }}</button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info pull-right">{{ trans('gayly.submit') }}</button>
            </div>
        </div>
</form>
