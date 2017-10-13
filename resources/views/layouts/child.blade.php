@php
	$parent = (new \Onini\Gayly\Models\Menu())->getCurrentParentNodes();
	$class = false !== collect($parent['parents'])->search($item['id']) ? 'class="active open"' : '';
@endphp
<li {!! $class !!}>
@if(!isset($item['children']))
	 <a href="{{ gayly_base_path($item['uri']) }}">{{ $item['title'] }}</a>
@else
     <a href="javascript:;">
         <span class="title">{{ $item['title'] }}</span>
         <span class="arrow"></span>
     </a>
     <ul class="sub-menu">
         @foreach($item['children'] as $item)
             @include('gayly::layouts.child', $item)
         @endforeach
     </ul>
@endif
</li>
