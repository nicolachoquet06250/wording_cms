window.contents = window.contents || {};
contents.load_HOME_content = () => console.log('load_HOME_content');
contents.load_INSCRIPTION_content = () => console.log('load_INSCRIPTION_content');
contents.load_LOGIN_content = () => console.log('load_LOGIN_content');
contents.load_LOGOUT_content = () => console.log('load_LOGOUT_content');
contents.load_ACCOUNT_content = () => console.log('load_ACCOUNT_content');
contents.load_PROJECTS_content = () => console.log('load_PROJECTS_content');

window.scripts = window.scripts || {};
scripts.load_HOME_scripts = () => {
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
};
scripts.load_INSCRIPTION_scripts = () => {
    fetch('/user/me', {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(r => r.json())
        .then(json => {
            if(json.data !== undefined && json.data.user !== undefined) window.location.href = '/';
        });

    $('form[action="/user/signup"]').on('submit', e => {
        e.preventDefault();
        let $form = $(e.target);
        fetch($form.attr('action'), {
            method: $form.attr('method'),
            body: JSON.stringify({
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                ident: $('#ident').val(),
                password: $('#password').val()
            })
        }).then(r => r.json())
            .then(json => {
                let $alert = $('.alert');
                if(json.data !== undefined && json.data.user !== undefined) {
                    $alert.addClass('d-none');
                    window.location.href = '/login';
                } else {
                    $alert.html(json.error.description);
                    $alert.removeClass('d-none');
                }
            });
    });

    $('#first_name, #last_name').each((_, elem) =>
        $(elem).on('keyup', () =>
            $('#ident').val(`${$('#first_name').val().toLowerCase()}.${$('#last_name').val().toLowerCase()}`)
        )
    );
};
scripts.load_LOGIN_scripts = () => {
    fetch('/user/me', {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(r => r.json())
        .then(json => {
        if(json.data !== undefined && json.data.user !== undefined) window.location.href = '/';
    });

    $('form[action="/user/login"]').on('submit', e => {
        e.preventDefault();
        let $form = $(e.target);
        fetch($form.attr('action'), {
            method: $form.attr('method'),
            body: JSON.stringify({
                ident: $('#ident').val(),
                password: $('#password').val()
            })
        }).then(r => r.json())
            .then(json => {
                let $alert = $('.alert');
                if(json.data !== undefined) {
                    if(!$alert.hasClass('d-none')) $alert.addClass('d-none');

                    if (json.data.user !== undefined) {
                        fetch($(e.target).attr('action'), {
                            method: $(e.target).attr('method'),
                            body: JSON.stringify({
                                ident: $('#ident').val(),
                                password: $('#password').val()
                            })
                        }).then(r => r.json())
                            .then(json => window.location.href = json.data.redirect)
                    } else if (json.data.redirect !== undefined) window.location.href = json.data.redirect;
                } else if(json.error !== undefined) {
                    $alert.html(json.error.description);
                    $alert.removeClass('d-none');
                }
            });
    });
};
scripts.load_LOGOUT_scripts = () => {
    fetch('/user/logout', {
        method: 'get',
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(r => r.json()).then(json => {
        if(json.data.status) {
            window.location.href = '/';
        }
    });
};
scripts.load_ACCOUNT_scripts = () => {
    $('#first_name, #last_name').each((_, elem) =>
        $(elem).on('keyup', () =>
            $('#ident').val(`${$('#first_name').val().toLowerCase()}.${$('#last_name').val().toLowerCase()}`)
        )
    );
};
scripts.load_PROJECTS_scripts = () => {
    $('.add-project-save').on('click', () => {
        $('form[action="/project"][method="post"]').submit();
    });

    $('.update-project-save').on('click', () => {
        $('form[action="/project"][method="put"]').submit();
    });

    $('form[action="/project"][method="post"]').on('submit', e => {
        e.preventDefault();
        let $form = $(e.target);
        fetch($form.attr('action'), {
            method: $form.attr('method'),
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: $('#name').val(),
                default_language_code: $('#default_language_code').val(),
                default_language_name: $('#default_language_name').val()
            })
        }).then(r => r.json())
            .then(json => {
                let $alert = $('.alert');
                if(json.data !== undefined) {
                    $alert.addClass('d-none');
                    window.location.reload();
                } else {
                    $('#exampleModal').trigger('close');
                    $alert.html(json.error.description);
                    $alert.removeClass('d-none');
                }
            });
    });

    $('form[action="/project"][method="put"]').on('submit', e => {
        e.preventDefault();
        let $form = $(e.target);
        fetch($form.attr('action'), {
            method: $form.attr('method'),
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: $('#id').val(),
                name: $('#to-update-name').val(),
                language_code: $('#to-update-default_language_code').val(),
                language_name: $('#to-update-default_language_name').val()
            })
        }).then(r => r.json())
            .then(json => {
                if(json.data !== undefined) {
                    let $alert = $('.alert');
                    if(json.data.success) {
                        $alert.addClass('d-none');
                        window.location.reload();
                    } else {
                        $('#exampleModal').trigger('close');
                        $alert.html(json.data.error.description);
                        $alert.removeClass('d-none');
                    }
                }
            });
    });

    $('.update-project').on('click', e => {
        let $button = $(e.target);
        let id = $button.data('id');

        fetch(`/project/${id}`, {
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(r => r.json())
            .then(json => {
                $('#id').val(id);
                $('#to-update-name').val(json.data.project.name);
                $('#to-update-default_language_code').val(json.data.project.default_language);
                $('#to-update-default_language_name').val(json.data.project.default_language_name);
            });
    });

    $('.remove-project').on('click', e => {
        let $button = $(e.target);
        fetch('/project', {
            method: 'delete',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: parseInt($button.data('id'))
            })
        }).then(r => r.json())
            .then(json => {
                if(json.data !== undefined) {
                    let $alert = $('.alert');
                    if(json.data.success) {
                        $alert.addClass('d-none');
                        window.location.reload();
                    } else {
                        $('#exampleModal').trigger('close');
                        $alert.html(json.data.error.description);
                        $alert.removeClass('d-none');
                    }
                }
            });
    });

    $('.remove-projects').on('click', () => {
        fetch('/projects', {
            method: 'delete',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(r => r.json()).then(json => {
            let $alert = $('.alert');
            if(json.data !== undefined && json.data.success) {
                $alert.addClass('d-none');
                window.location.reload();
            } else {
                $('#exampleModal').trigger('close');
                $alert.html(json.data.error.description);
                $alert.removeClass('d-none');
            }
        })
    });

    $('.project-details').on('click', e => {
        let $button = $(e.target);
        if(e.target.tagName !== 'A')
            $button = $($button.parent('div').parent('a'));
        let id = $button.data('id');

        fetch(`/project/${id}`, {
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(r => r.json())
            .then(json => {
                let project = json.data.project;
                let name = project.name;
                let languages = project.languages;
                let language_tpl = `<li class="list-group-item list-group-item-action flex-column align-items-start">
    <a href="#/" class="choose-language" data-lang="{code}">
        {name}
        <span class="badge badge-primary badge-pill">{code}</span>
    </a>
</li>`;
                let page_tpl = `<li class="list-group-item list-group-item-action flex-column align-items-start">
    <a href="#/" class="choose-page" data-page="{page}">
        {name}
        <span class="badge badge-primary badge-pill">{property_nb}</span>
    </a>
</li>`;
                $('#project-details-label').html(name);
                $('#languages').html('');
                for(let id in languages) {
                    let language = languages[id];
                    $('#languages').html($('#languages').html() + language_tpl
                        .replace(/\{code\}/g, language.code)
                        .replace('{name}', language.name));
                }

                $('.choose-language').on('click', e => {
                    let $lang = $(e.target);
                    let lang = $lang.data('lang');
                    $('#pages').html('');
                    for(let id in languages) {
                        let language = languages[id];
                        if(language.code === lang) {
                            for(let _id in language.pages) {
                                let page = language.pages[_id];
                                let properties_length = 0;
                                for(let i in page.properties) properties_length++;
                                $('#pages').html($('#pages').html() + page_tpl
                                    .replace('{name}', page.name)
                                    .replace('{page}', page.id)
                                    .replace('{property_nb}', properties_length.toString()));
                            }
                            break;
                        }
                    }

                    $('.choose-page').on('click', e => {
                        let $page = $(e.target);
                        let page_id = parseInt($page.data('page'));
                        for(let id in languages) {
                            let language = languages[id];
                            if(language.code === lang) {
                                for(let _id in language.pages) {
                                    if(parseInt(_id) === page_id) {
                                        let page = language.pages[_id];
                                        let properties = page.properties;
                                        for(let i in properties) {
                                            $('#page-properties').html($('#page-properties').html() + `<tr>
                                        <td>
    <div class="form-group col-12">
        <label for="property-key" style="margin-left: 15px;">Clé de propriété</label>
        <input  type="text" class="form-control" id="property-key" placeholder="Clé de propriété" 
                value="${properties[i].key}" />
    </div>
</td>
                                        <td>
    <div class="form-group col-12">
        <label for="property-value" style="margin-left: 15px;">Valeur de propriété</label>
        <input  type="text" class="form-control" id="property-value" placeholder="Valeur de propriété" 
                value="${properties[i].value}" />
    </div>
</td>
                                    </tr>`);
                                        }
                                        break;
                                    }
                                }
                            }
                        }
                        $('#properties-tab').click();
                    });
                    $('#pages-tab').click();
                });
            });
    })
};

window.styles = window.styles || {};
styles.load_HOME_styles = () => console.log('load_HOME_styles');
styles.load_INSCRIPTION_styles = () => console.log('load_INSCRIPTION_styles');
styles.load_LOGIN_styles = () => console.log('load_LOGIN_styles');
styles.load_LOGOUT_styles = () => console.log('load_LOGOUT_styles');
styles.load_ACCOUNT_styles = () => console.log('load_ACCOUNT_styles');
styles.load_PROJECTS_styles = () => console.log('load_PROJECTS_styles');
