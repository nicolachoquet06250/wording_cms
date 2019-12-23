$(window).ready(() => {
    let observers = {
        HOME: 'HOME',
        INSCRIPTION: 'INSCRIPTION',
        CONNECTION: 'LOGIN',

        menus: [
            'HOME',
            'INSCRIPTION',
            'LOGIN'
        ],
        _menu_: null,
        set menu(menu) {
            let oldMenu = this._menu_;
            if(oldMenu !== menu) {
                this.onMenuChange(menu, oldMenu);
            }
            this._menu_ = menu;
        },
        get menu() {
            return this._menu_;
        },
        onMenuChange(newMenu, oldMenu) {
            if(oldMenu !== null) {
                window.menus[`unload_${oldMenu}_menu`]();
            }
            window.menus[`load_${newMenu}_menu`]();
            if(oldMenu !== null) {
                window.contents[`unload_${oldMenu}_content`]();
            }
            window.contents[`load_${newMenu}_content`]();
            if(oldMenu !== null) {
                window.styles[`unload_${oldMenu}_styles`]();
            }
            window.styles[`load_${newMenu}_styles`]();
            if(oldMenu !== null) {
                window.scripts[`unload_${oldMenu}_scripts`]();
            }
            window.scripts[`load_${newMenu}_scripts`]();
        },

        init_menu() {
            this.menu = this.menus[0];
        }
    };
    observers.init_menu();
});