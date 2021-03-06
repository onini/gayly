@if(Gayly::user()->visible($item['roles']))
	@php
	$parent = (new \Onini\Gayly\Models\Menu())->getCurrentParentNodes();
	$class = false !== collect($parent['parents'])->search($item['id']) ? 'class="active open"' : '';
	@endphp
<li {!! $class !!}>
 @if(!isset($item['children']))
         @if(url()->isValidUrl($item['uri']))
             <a href="{{ $item['uri'] }}" target="_blank">
         @else
              <a href="{{ gayly_base_path($item['uri']) }}">
         @endif
 			<i class="fa {{ $item['icon'] }} fa-lg sidebar-icon"></i>
 			<span class="title">{{ $item['title'] }}</span>
 			{{-- <span class=" badge badge-disable pull-right ">203</span> --}}
         </a>
 @else
 		<a href="javascript:;">
 			<i class="fa {{ $item['icon'] }} fa-lg sidebar-icon"></i>
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
@endif
