<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

	<label for="{{$id}}" class="{{$viewClass['label']}} form-label">{{$label}}</label>

	<div class="{{$viewClass['field']}}">

		@include('gayly::form.error')

		<input type="hidden" name="{{$name}}" />

		<select class="{{$class}} method" style="width: 100%;" name="{{$name}}" {!! $attributes !!} style="width:100%">
            @foreach($options as $select => $option)
                <option value="{{$select}}" {{ $select == old($column, $value) ?'selected':'' }}>{{$option}}</option>
            @endforeach
        </select>

        @include('gayly::form.help-block')

	</div>
</div>
