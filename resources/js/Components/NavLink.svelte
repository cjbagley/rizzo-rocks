<script>
    import {Link} from "@inertiajs/svelte";

    export let href;

    function clear() {
        document.getElementById('search').value = '';
    }
</script>

<Link {href} on:click={clear} class="desktop-nav-link" aria-current="page" replace>
    <slot/>
</Link>

<style>
    :global(.desktop-nav-link) {
        font-size: 29px;
        color: #fff;
        font-weight: bold;
        padding: 8px 12px;
    }

    :global(.desktop-nav-link:hover) {
        color: #1e3a8a;
    }

    :global(.dark-theme .desktop-nav-link) {
        color: #000 !important;
    }
</style>
