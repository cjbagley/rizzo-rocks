<script>
    import Header from "../Components/Header.svelte";
    export let header = "";
</script>

<main>
    {#if header}
        <div class="card card-header">
            <Header {header} />
        </div>
    {/if}
    <div class="card card-body">
        <slot />
    </div>
</main>

<style>
    main {
        padding-top: 20px;
    }

    .card {
        background-color: #fff;
        border: 2px solid #000;
        border-radius: 8px;
        margin-left: 12px;
        margin-right: 12px;
        max-width: 1280px;
    }

    @media (min-width: 1280px) {
        .card {
            margin-right: auto;
            margin-left: auto;
        }
    }

    :global(.dark-theme) .card {
        background-color: #000;
        border-color: #a1a1aa;
    }

    .card-header {
        padding-left: 20px;
        padding-right: 20px;
    }

    .card-body {
        font-size: 24px;
        line-height: 24px;
        margin-top: 20px;
        padding: 24px;
    }
</style>
