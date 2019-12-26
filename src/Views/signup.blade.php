@extends('layouts.frameworks.bootstrap')

@section('custom_css')
    <link rel="stylesheet" href="/public/css/styles.css" />
@endsection

@section('custom_js')
    <script src="/public/js/init_bootstrap_material_design.js"></script>
    <script src="/public/js/unloaders.js"></script>
    <script src="/public/js/loaders.js"></script>
    <script src="/public/js/observers.js"></script>
    <script>$(window).ready(() => observers.init_menu(observers.INSCRIPTION));</script>
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Inscription</h2>
                                        </div>
                                    </div>
                                </div>
                                <form class="container" action="/user/login" METHOD="post">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="first_name">Prénom</label>
                                            <input type="text" class="form-control" id="first_name" placeholder="Prénom" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="last_name">Nom</label>
                                            <input type="text" class="form-control" id="last_name" placeholder="Nom" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="ident">Identifiant</label>
                                            <input type="text" class="form-control" id="ident" placeholder="Identifiant" disabled />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="password">Mot de passe</label>
                                            <input type="password" class="form-control" id="password" placeholder="Mot de passe" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-primary">M'inscrire</button>
                                        </div>
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