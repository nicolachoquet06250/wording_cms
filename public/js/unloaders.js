$(window).ready(() => {
    window.menus = window.menus || {};
    menus.unload_HOME_menu = () => {
        console.log('unload_HOME_menu');
    };
    menus.unload_INSCRIPTION_menu = () => {
        console.log('unload_INSCRIPTION_menu');
    };
    menus.unload_CONNECTION_menu = () => {
        console.log('unload_CONNECTION_menu');
    };

    window.contents = window.contents || {};
    contents.unload_HOME_content = () => {
        console.log('unload_HOME_content');
    };
    contents.unload_INSCRIPTION_content = () => {
        console.log('unload_INSCRIPTION_content');
    };
    contents.unload_CONNECTION_content = () => {
        console.log('unload_CONNECTION_content');
    };

    window.scripts = window.scripts || {};
    scripts.unload_HOME_scripts = () => {
        console.log('unload_HOME_scripts');
    };
    scripts.unload_INSCRIPTION_scripts = () => {
        console.log('unload_INSCRIPTION_scripts');
    };
    scripts.unload_CONNECTION_scripts = () => {
        console.log('unload_CONNECTION_scripts');
    };

    window.styles = window.styles || {};
    styles.unload_HOME_styles = () => {
        console.log('unload_HOME_styles');
    };
    styles.unload_INSCRIPTION_styles = () => {
        console.log('unload_INSCRIPTION_styles');
    };
    styles.unload_CONNECTION_styles = () => {
        console.log('unload_CONNECTION_styles');
    };
});