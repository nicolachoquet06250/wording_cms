window.menus = window.menus || {};
menus.load_HOME_menu = () => {
    console.log('load_HOME_menu');
};
menus.load_INSCRIPTION_menu = () => {
    console.log('load_INSCRIPTION_menu');
};
menus.load_LOGIN_menu = () => {
    console.log('load_LOGIN_menu');
};
menus.load_LOGOUT_menu = () => {
    console.log('load_LOGOUT_menu');
};
menus.load_ACCOUNT_menu = () => {
    console.log('load_ACCOUNT_menu');
};

window.contents = window.contents || {};
contents.load_HOME_content = () => {
    console.log('load_HOME_content');
};
contents.load_INSCRIPTION_content = () => {
    console.log('load_INSCRIPTION_content');
};
contents.load_LOGIN_content = () => {
    console.log('load_LOGIN_content');
};
contents.load_LOGOUT_content = () => {
    console.log('load_LOGOUT_content');
};
contents.load_ACCOUNT_content = () => {
    console.log('load_ACCOUNT_content');
};

window.scripts = window.scripts || {};
scripts.load_HOME_scripts = () => {
    console.log('load_HOME_scripts');
};
scripts.load_INSCRIPTION_scripts = () => {
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
        fetch($(e.target).attr('action'), {
            method: $(e.target).attr('method'),
            body: JSON.stringify({
                ident: $('#ident').val(),
                password: $('#password').val()
            })
        }).then(r => r.json())
            .then(json => {
                if(json.data.user !== undefined) {
                    fetch($(e.target).attr('action'), {
                        method: $(e.target).attr('method'),
                        body: JSON.stringify({
                            ident: $('#ident').val(),
                            password: $('#password').val()
                        })
                    }).then(r => r.json())
                        .then(json => window.location.href = json.data.redirect)
                } else if (json.data.redirect !== undefined) window.location.href = json.data.redirect;
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

window.styles = window.styles || {};
styles.load_HOME_styles = () => {
    console.log('load_HOME_styles');
};
styles.load_INSCRIPTION_styles = () => {
    console.log('load_INSCRIPTION_styles');
};
styles.load_LOGIN_styles = () => {
    console.log('load_LOGIN_styles');
};
styles.load_LOGOUT_styles = () => {
    console.log('load_LOGOUT_styles');
};
styles.load_ACCOUNT_styles = () => {
    console.log('load_ACCOUNT_styles');
};