<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
    <label for="{{$id}}" class="{{$viewClass['label']}} form-label">{{$label}}</label>
	@include('gayly::form.help-block')
    <div class="{{$viewClass['field']}}">
		@include('gayly::form.error')
		<div class="input-group ">
			@if ($prepend)
                <span class="input-group-addon">
					{!! $prepend !!}
				</span>
            @endif
            <input {!! $attributes !!} />
            @if ($append)
                <span class="input-group-addon clearfix">{!! $append !!}</span>
            @endif
      	</div>
    </div>
</div>
