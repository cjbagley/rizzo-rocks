<script>
    import Nav from "../Components/Nav.svelte";
</script>

<div class="background flex-column">
    <Nav/>
    <main class="flex-column">
        <slot/>
    </main>
</div>

<style>
    main {
        height: 100%;
        gap: 30px;
        align-items: center;
        padding: 0 30px 30px;
    }

    .background {
        background-color: #fff;

        /* Hat-tip: https://stackoverflow.com/a/32861765 */
        background-size: 40px 40px;
        background-image: linear-gradient(to right, silver 1px, transparent 1px),
        linear-gradient(to bottom, silver 1px, transparent 1px);
        color: #000;
        min-height: 100%;
        gap: 30px;
        width: 100vw;
    }

    :global(.dark-theme) .background {
        background-color: #000;
        color: #fff;
    }
</style>
