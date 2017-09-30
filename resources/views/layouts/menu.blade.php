@if(Gayly::user()->visible($item['roles']))
	@if(!isset($item['children']))
        <li>
            @if(url()->isValidUrl($item['uri']))
                <a href="{{ $item['uri'] }}" target="_blank">
            @else
                 <a href="{{ gayly_url($item['uri']) }}">
            @endif
                <i class="material-icons">{{ $item['icon'] }}</i>
                <span>{{ $item['title'] }}</span>
            </a>
        </li>
    @else
		<li class="">
			<a href="javascript:;">
				<i class="material-icons">{{ $item['icon'] }}</i>
				<span class="title">{{ $item['title'] }}</span>
				<span class="arrow"></span>
			</a>
			<ul class="sub-menu">
				@foreach($item['children'] as $item)
                    @include('gayly::layouts.menu', $item)
                @endforeach
			</ul>
		</li>
    @endif
@endif
