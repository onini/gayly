<div class="input-group transparent">
	<span class="input-group-addon ">
		<i class="fa fa-{{ $icon }}"></i>
  	</span>
	<input type="{{ $type }}" class="form-control {{ $id }}" placeholder="{{ $placeholder }}" name="{{$name}}" value="{{ request($name, $value) }}">
</div>
