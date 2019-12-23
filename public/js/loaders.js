$(window).ready(() => {
    window.menus = window.menus || {};
    menus.load_HOME_menu = () => {
        console.log('load_HOME_menu');
    };
    menus.load_INSCRIPTION_menu = () => {
        console.log('load_INSCRIPTION_menu');
    };
    menus.load_CONNECTION_menu = () => {
        console.log('load_CONNECTION_menu');
    };

    window.contents = window.contents || {};
    contents.load_HOME_content = () => {
        console.log('load_HOME_content');
    };
    contents.load_INSCRIPTION_content = () => {
        console.log('load_INSCRIPTION_content');
    };
    contents.load_CONNECTION_content = () => {
        console.log('load_CONNECTION_content');
    };

    window.scripts = window.scripts || {};
    scripts.load_HOME_scripts = () => {
        console.log('load_HOME_scripts');
    };
    scripts.load_INSCRIPTION_scripts = () => {
        console.log('load_INSCRIPTION_scripts');
    };
    scripts.load_CONNECTION_scripts = () => {
        console.log('load_CONNECTION_scripts');
    };

    window.styles = window.styles || {};
    styles.load_HOME_styles = () => {
        console.log('load_HOME_styles');
    };
    styles.load_INSCRIPTION_styles = () => {
        console.log('load_INSCRIPTION_styles');
    };
    styles.load_CONNECTION_styles = () => {
        console.log('load_CONNECTION_styles');
    };
});