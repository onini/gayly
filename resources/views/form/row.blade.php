<div class="row">
    @foreach($fields as $field)
    <div class="col-md-{{ $field['width'] }} col-md-offset-{{ $field['offset'] }}">
        {!! $field['element']->render() !!}
    </div>
    @endforeach
</div>
