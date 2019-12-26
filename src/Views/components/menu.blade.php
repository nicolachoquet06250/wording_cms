@php
    $items = $items ?? [];
    $title = $title ?? '';
    $responsive_title = $responsive_title ?? '';
@endphp

<nav class="bmd-layout-header navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <span class="btn-group-lg">
                        <button class="btn btn-secondary bmd-btn-fab navbar-toggler"
                                type="button" data-toggle="drawer" data-target="#dw-s1">
                            <span class="sr-only">Toggle drawer</span>
                            <i class="material-icons">more_vert</i>
                        </button>
                    </span>
                </div>
                <div class="col-10 col-md-12 text-center d-none d-lg-block">
                    <h1>{{$title}}</h1>
                </div>
            </div>
        </div>
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @foreach($items as $item)
                @php $selected = isset($item['selected']) ? $item['selected'] : false @endphp
                <li class="nav-item{{$selected ? ' active' : ''}}">
                    <a class="nav-link" href="{{$item['href']}}">{{$item['title']}}@if($selected) <span class="sr-only">(current)</span>@endif</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
<div id="dw-s1" class="bmd-layout-drawer bg-faded">
    <header>
        <a class="navbar-brand text-center">
            <h1>{!! $responsive_title !!}</h1>
        </a>
    </header>
    <ul class="list-group">
        @foreach($items as $item)
            @php $selected = isset($item['selected']) ? $item['selected'] : false @endphp
            <a class="list-group-item{{$selected ? ' active' : ''}}" href="{{$item['href']}}">{{$item['title']}}@if($selected) <span class="sr-only">(current)</span>@endif</a>
        @endforeach
    </ul>
</div>