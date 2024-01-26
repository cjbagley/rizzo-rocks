<script>
    import Header from "../Components/Header.svelte";
    export let header = "";
</script>

<main class="space-y-5 pt-10">
    {#if header}
        <div class="card px-5">
            <Header {header} />
        </div>
    {/if}
    <div class="card space-y-2 p-6 text-2xl">
        <slot />
    </div>
</main>
