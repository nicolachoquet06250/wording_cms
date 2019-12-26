@extends('layouts.frameworks.bootstrap')

@section('custom_css')
    <link rel="stylesheet" href="/public/css/styles.css" />
@endsection

@section('custom_js')
    @if(is_null($user))<script>window.location.href = '/';</script>@endif
    <script src="/public/js/init_bootstrap_material_design.js"></script>
    <script src="/public/js/unloaders.js"></script>
    <script src="/public/js/loaders.js"></script>
    <script src="/public/js/observers.js"></script>
    <script>$(window).ready(() => observers.init_menu(observers.ACCOUNT));</script>
@endsection

@section('body')
    <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
        @component('components.menu', [
            'title' => 'Mon compte',
            'responsive_title' => 'Mon<br />compte',
            'items' => $menu_items ?? []
        ])@endcomponent
        <main class="bmd-layout-content pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success" role="alert">
                                                Bienvenue sur `mon compte`
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="container" action="/user/me" method="put">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="ident">Identifiant</label>
                                            <input type="text" class="form-control" id="ident" placeholder="Identifiant" value="{{!is_null($user) ? $user->getIdent() : ''}}" disabled />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="last_name">Nom</label>
                                            <input type="text" class="form-control" id="last_name" placeholder="Nom" value="{{!is_null($user) ? $user->getLastName() : ''}}" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="first_name">Prénom</label>
                                            <input type="text" class="form-control" id="first_name" placeholder="Prénom" value="{{!is_null($user) ? $user->getFirstName() : ''}}" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="password">Mot de passe</label>
                                            <input type="password" class="form-control" id="password" placeholder="Mot de passe" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection