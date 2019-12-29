@extends('layouts.frameworks.bootstrap')

@section('custom_css')
    <link rel="stylesheet" href="/public/css/styles.css" />
@endsection

@section('custom_js')
    <script src="/public/js/init_bootstrap_material_design.js"></script>
    <script src="/public/js/unloaders.js"></script>
    <script src="/public/js/loaders.js"></script>
    <script src="/public/js/observers.js"></script>
    <script>$(window).ready(() => observers.init_menu(observers.PROJECTS));</script>
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
                        <div class="alert alert-danger d-none" role="alert"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h1>Mes projets</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="list-group">
                                                @if(count($projects) === 0)
                                                    <a class="list-group-item list-group-item-action flex-column align-items-start" href="#">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1 ml-3">Vous n'avez aucun projets</h5>
                                                            <small>fr</small>
                                                        </div>
                                                    </a>
                                                @endif
                                                @foreach($projects as $project)
                                                    <a class="list-group-item list-group-item-action flex-column align-items-start" href="#">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1 ml-3">{{$project->getName()}}</h5>
                                                            <small>{{$project->getDefaultLanguage()}}</small>
                                                        </div>
                                                        <div class="mb-1">
                                                            <button class="btn btn-primary remove-project"
                                                                    data-id="{{$project->getId()}}">Supprimer</button>
                                                            <button class="btn btn-primary update-project"
                                                                    data-id="{{$project->getId()}}"
                                                                    data-toggle="modal"
                                                                    data-target="#update-project">Modifier</button>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary"
                                        data-toggle="modal"
                                        data-target="#create-project">Créer un projet</button>
                                <button class="btn btn-primary remove-projects">Vider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="create-project" tabindex="-1" role="dialog" aria-labelledby="create-project-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-project-label">Créer un projet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="container" action="/project" method="post">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="name">Nom du projet</label>
                                <input type="text" class="form-control" id="name" placeholder="Nom du projet" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="default_language_code">Code de la langue par default</label>
                                <input type="text" class="form-control" id="default_language_code" placeholder="Code de la langue par default" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="default_language_name">Nom de la langue par default</label>
                                <input type="text" class="form-control" id="default_language_name" placeholder="Nom de la langue par default" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary add-project-save">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-project" tabindex="-1" role="dialog" aria-labelledby="update-project-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-project-label">Modifier un projet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="container" action="/project" method="put">
                        <input type="hidden" id="id" />
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="to-update-name">Nom du projet</label>
                                <input type="text" class="form-control" id="to-update-name" placeholder="Nom du projet" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="to-update-default_language_code">Code de la langue par default</label>
                                <input type="text" class="form-control" id="to-update-default_language_code" placeholder="Code de la langue par default" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="to-update-default_language_name">Nom de la langue par default</label>
                                <input type="text" class="form-control" id="to-update-default_language_name" placeholder="Nom de la langue par default" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary update-project-save">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
