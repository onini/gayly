<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} form-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('gayly::form.error')

        <input type="checkbox" class="{{$class}} la_checkbox" {{ old($column, $value) == 'on' ? 'checked' : '' }} {!! $attributes !!} />
        <input type="hidden" class="{{$class}}" name="{{$name}}" class="" value="{{ old($column, $value) }}" />

        @include('gayly::form.help-block')

    </div>
</div>
