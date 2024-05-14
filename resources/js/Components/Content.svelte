<script>
    import Header from "../Components/Header.svelte";

    export let header = "";
</script>

{#if header}
    <div class="card card-header">
        <Header {header}/>
    </div>
{/if}
<div class="card card-body">
    <slot/>
</div>

<style>
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
            margin-left: auto;
            margin-right: auto;
            width: 100%;
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
        padding: 24px;
    }
</style>
