<li class="dd-item" data-id="{{ $branch[$keyName] }}">
    <div class="dd-handle">
        {!! $branchCallback($branch) !!}
        <span class="pull-right dd-nodrag">
            @isset($branch['uri'])
                <a href="{{ gayly_base_path($branch['uri']) }}" style="color: #b6bfc5"><i class="fa fa-eye"></i></a>
            @endisset

            @if (isset($branch['ab']) && $branch['ab'] !== '/')
                <a href="{{ $path }}/{{ $branch[$keyName] }}/edit" class="text-success"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" data-id="{{ $branch[$keyName] }}" class="text-error tree_branch_delete"><i class="fa fa-trash"></i></a>
            @endif
        </span>
    </div>
    @if(isset($branch['children']))
    <ol class="dd-list">
        @foreach($branch['children'] as $branch)
            @include($branchView, $branch)
        @endforeach
    </ol>
    @endif
</li>
