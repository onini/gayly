@if(!isset($item['children']))
@php
	$parent = (new \Onini\Gayly\Models\Menu())->getCurrentParentNodes(request());
	$class = collect($parent['parents'])->search($parent['current_id']) ? 'active open' : '';
@endphp
 <li>
	 <a href="{{ gayly_base_path($item['uri']) }}">{{ $item['title'] }}</a>
 </li>
@else
 <li>
     <a href="javascript:;">
         <span class="title">{{ $item['title'] }}</span>
         <span class="arrow"></span>
     </a>
     <ul class="sub-menu">
         @foreach($item['children'] as $item)
             @include('gayly::layouts.child', $item)
         @endforeach
     </ul>
 </li>
@endif
