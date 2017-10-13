<div {!! $attributes !!}>
    <ul class="nav nav-tabs" role="tablist">

        @foreach($tabs as $id => $tab)
        <li {{ $id == $active ? 'class=active' : '' }}><a href="#tab_{{ $tab['id'] }}" role="tab" data-toggle="tab">{{ $tab['title'] }}</a></li>
        @endforeach

        @if (!empty($dropDown))
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                @foreach($dropDown as $link)
                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ $link['href'] }}">{{ $link['name'] }}</a></li>
                @endforeach
            </ul>
        </li>
        @endif
    </ul>
    <div class="tab-content">
        @foreach($tabs as $id => $tab)
        <div class="tab-pane {{ $id == $active ? 'active' : '' }}" id="tab_{{ $tab['id'] }}">
            {!! $tab['content'] !!}
        </div>
        @endforeach
    </div>
</div>
