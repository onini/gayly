<form {!! $attributes !!}>
        @foreach($fields as $field)
            {!! $field->render() !!}
        @endforeach
        <div class="clearfix">

        </div>
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-sm-2 pull-left">
                    <div class="btn-group">
                        <button type="reset" class="btn btn-danger btn-cons">{{ trans('gayly.reset') }}</button>
                    </div>
                </div>
                <div class="col-sm-2 pull-right">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-info btn-cons pull-right">{{ trans('gayly.submit') }}</button>
                    </div>
                </div>
            </div>
        </div>
</form>
