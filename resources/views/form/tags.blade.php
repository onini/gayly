<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} form-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('gayly::form.error')

        <select class="form-control {{$class}}" style="width: 100%;" name="{{$name}}[]" multiple="multiple" data-placeholder="{{ $placeholder }}" {!! $attributes !!} >
            @foreach($value as $select)
                <option value="{{$select}}" selected>{{$select}}</option>
            @endforeach
        </select>
        <input type="hidden" name="{{$name}}[]" />

        @include('gayly::form.help-block')

    </div>
</div>
<style media="screen">
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ddd;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #fff
    }
</style>
