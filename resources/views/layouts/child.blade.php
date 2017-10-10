
 @if(!isset($item['children']))
     <li @if (request()->getPathInfo() == gayly_base_path($item['uri']))
         class="active"
     @endif>
    	 <a href="{{ gayly_base_path($item['uri']) }}">{{ $item['title'] }}</a>
     </li>
 @else
     <li class="">
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
