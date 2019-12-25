<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>WORDING CMS</title>

        <!-- Material Design for Bootstrap fonts and icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" rel="stylesheet"/>
        <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"></script>
        <link rel="stylesheet" href="/public/css/styles.css" />
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
    </head>
    <body>
        <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
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
                                <h1>WORDING CMS</h1>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="javascript:observers.menu=observers.HOME">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:observers.menu=observers.INSCRIPTION">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:observers.menu=observers.CONNECTION">Connection</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="dw-s1" class="bmd-layout-drawer bg-faded">
                <header>
                    <a class="navbar-brand text-center">
                        <h1>WORDING<br />CMS</h1>
                    </a>
                </header>
                <ul class="list-group">
                    <a class="list-group-item active" href="javascript:observers.menu=observers.HOME">Home <span class="sr-only">(current)</span></a>
                    <a class="list-group-item" href="javascript:observers.menu=observers.INSCRIPTION">Inscription</a>
                    <a class="list-group-item" href="javascript:observers.menu=observers.CONNECTION">Connection</a>
                </ul>
            </div>
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
    </body>
</html>