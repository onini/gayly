<select class="select2 {{ $class }}" name="{{ $name }}" style="width:100%">
	@foreach($options as $select => $option)
        <option value="{{$select}}" {{ (string)$select === request($name, $value) ?'selected':'' }}>{{$option}}</option>
    @endforeach
</select>
