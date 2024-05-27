<script>
    import Header from "../Components/Header.svelte";

    export let header = "";
</script>

{#if header}
    <div class="card card-header">
        <Header {header}/>
    </div>
{/if}
<div class="card card-body flex-column">
    <slot/>
</div>

<style>
    .card {
        background-color: #fff;
        border: 2px solid #000;
        border-radius: 8px;
        max-width: 1280px;
        height: 100%;
        width: 100%;
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
        row-gap: 20px;
    }
</style>
