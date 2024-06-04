import '../css/reset.css';
import '../css/app.css';
import {createInertiaApp} from "@inertiajs/svelte";
import Layout from "./Layouts/Layout.svelte";
import {router} from '@inertiajs/svelte';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.svelte', {eager: true});
        let page = pages[`./Pages/${name}.svelte`];
        return {default: page.default, layout: page.layout || Layout};
    },
    setup({el, App, props}) {
        new App({target: el, props});
    },
});

// Thanks https://stackoverflow.com/questions/13382516/getting-scroll-bar-width-using-javascript/13382873#13382873
function getScrollbarWidth() {
    // Creating invisible container
    const outer = document.createElement('div');
    outer.style.visibility = 'hidden';
    outer.style.overflow = 'scroll'; // forcing scrollbar to appear
    outer.style.msOverflowStyle = 'scrollbar'; // needed for WinJS apps
    document.body.appendChild(outer);

    // Creating inner element and placing it in the container
    const inner = document.createElement('div');
    outer.appendChild(inner);

    // Calculating difference between container's full width and the child width
    const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);

    // Removing temporary elements from the DOM
    outer.parentNode.removeChild(outer);

    return scrollbarWidth;
}

function scrollbarVisible() {
    return document.documentElement.scrollHeight > document.documentElement.clientHeight;
}

function handleScrollbar() {
    if (scrollbarVisible()) {
        document.body.style.paddingRight = '0px';
        return;
    }

    document.body.style.paddingRight = `${getScrollbarWidth()}px`;
}

router.on('finish', (event) => {
    handleScrollbar();
});

window.addEventListener("load", (event) => {
    handleScrollbar();
});
