<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} form-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('gayly::form.error')

        <textarea class="form-control" id="{{$id}}" name="{{$name}}" placeholder="{{ $placeholder }}" {!! $attributes !!} >{{ old($column, $value) }}</textarea>

        @include('gayly::form.help-block')

    </div>
</div>

<style media="screen">
    .cke_chrome {
        border-radius: 5px;
    }

    .cke_top {
        background: none;
    }

    .cke_inner {
        border-radius: 5px
    }

    .cke_bottom {
        background: none
    }
</style>
