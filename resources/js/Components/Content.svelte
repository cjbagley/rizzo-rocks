<script>
    import Header from "../Components/Header.svelte";

    export let header = "";
</script>

<div>
    {#if header}
        <div class="card card-header">
            <Header {header}/>
        </div>
    {/if}
    <div class="card card-body">
        <slot/>
    </div>
</div>

<style>
    main {
        padding-top: 30px;
    }

    .card {
        background-color: #fff;
        border: 2px solid #000;
        border-radius: 8px;
        margin-left: 12px;
        margin-right: 12px;
        max-width: 1280px;
        height: 100%;
    }

    @media (width >= 1280px) {
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
        margin-top: 30px;
        padding: 24px;
    }
</style>
