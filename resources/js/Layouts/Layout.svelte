<script>
    import Nav from "../Components/Nav.svelte";
</script>

<Nav />
<div class="background">
    <slot />
</div>

<style>
    .background {
        background-color: #fff;
        /* Hat-tip: https://stackoverflow.com/a/32861765 */
        background-size: 40px 40px;
        background-image: linear-gradient(to right, silver 1px, transparent 1px),
            linear-gradient(to bottom, silver 1px, transparent 1px);
        color: #000;
        min-height: 100%;
    }

    :global(.dark-theme) .background {
        background-color: #000;
        color: #fff;
    }
</style>
