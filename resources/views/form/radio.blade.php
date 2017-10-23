<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} form-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('gayly::form.error')

        @foreach($options as $option => $label)
            @if(!$inline)<div class="radio radio-success">@endif
                <input id="male-{{$option}}" type="radio" name="{{$name}}" value="{{$option}}" class="minimal {{$class}}" {{ ($option == old($column, $value))?'checked':'' }} />
                <label for="male-{{$option}}">{{$label}}</label>
            @if(!$inline)</div>@endif
        @endforeach

        @include('gayly::form.help-block')

    </div>
</div>
