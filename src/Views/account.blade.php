@extends('layouts.frameworks.bootstrap')

@section('body')
    <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
        @component('components.menu', [
            'title' => 'Mon compte',
            'responsive_title' => 'Mon<br />compte',
            'items' => [
                [
                    'title' => 'Home',
                    'href' => '/'
                ],
                [
                    'title' => 'Mon compte',
                    'href' => '/me',
                    'selected' => true
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Connection</h2>
                                        </div>
                                    </div>
                                </div>
                                <form class="container" action="/user/login" METHOD="post">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="ident">Identifiant</label>
                                            <input type="text" class="form-control" id="ident" placeholder="Identifiant" />
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="password">Mot de passe</label>
                                            <input type="password" class="form-control" id="password" placeholder="Mot de passe" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Me connecter</button>
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