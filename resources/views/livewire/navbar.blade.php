<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($navbarBreadCrumbItens as $navbarBreadCrumbItem)
                    <li @class(['breadcrumb-item', 'active' => $navbarBreadCrumbItem->getAtivo()]) {{ $navbarBreadCrumbItem->getAtivo() ? 'aria-current=page' : ''}}>
                        @if ($navbarBreadCrumbItem->getAtivo())
                            {{$navbarBreadCrumbItem->getNome()}}
                        @else
                            <a href="{{$navbarBreadCrumbItem->getLink()}}">{{$navbarBreadCrumbItem->getNome()}}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</nav>
