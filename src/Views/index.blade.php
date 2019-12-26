@extends('layouts.frameworks.bootstrap')

@section('body')
    <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
        @component('components.menu', [
            'title' => 'WORDING CMS',
            'responsive_title' => 'WORDING<br />CMS',
            'items' => [
                [
                    'title' => 'Home',
                    'href' => '/',
                    'selected' => true
                ],
                [
                    'title' => 'Mon compte',
                    'href' => '/me'
                ],
                [
                    'title' => 'Connection',
                    'href' => '/login'
                ]
            ]
        ])@endcomponent
        <main class="bmd-layout-content pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-body">
                                HELLO, VOUS ETES SUR LA HOME DE L'APPLICATION WORDING CMS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection