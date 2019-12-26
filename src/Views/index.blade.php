@extends('layouts.frameworks.bootstrap')

@section('custom_css')
    <link rel="stylesheet" href="/public/css/styles.css" />
@endsection

@section('custom_js')
    <script src="/public/js/init_bootstrap_material_design.js"></script>
    <script src="/public/js/unloaders.js"></script>
    <script src="/public/js/loaders.js"></script>
    <script src="/public/js/observers.js"></script>
    <script>
        $(window).ready(() => {
            $('form[action="/user/login"]').on('submit', e => {
                e.preventDefault();
                fetch($(e.target).attr('action'), {
                    method: $(e.target).attr('method'),
                    body: JSON.stringify({
                        ident: $('#ident').val(),
                        password: $('#password').val()
                    })
                }).then(r => r.json()).then(json => {
                    console.log(json);
                });
                fetch('/user/me', {
                    method: 'get'
                }).then(r => r.json()).then(json => {
                    console.log(json);
                });
            });
        });
    </script>
@endsection

@section('body')
    <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
        @component('components.menu', [
            'title' => 'WORDING CMS',
            'responsive_title' => 'WORDING<br />CMS',
            'items' => $menu_items ?? []
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