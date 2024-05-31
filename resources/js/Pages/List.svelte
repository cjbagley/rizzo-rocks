<script>
    import Content from "../Components/Content.svelte";
    import Pagination from "@/Components/Pagination.svelte";

    export let appName;
    export let gameList;

    let captures;
    export let data;
</script>

<svelte:head>
    <title>{appName} - {gameList}</title>
</svelte:head>

<Content header={gameList}>
    {#if captures}
        {#each captures as capture}
            <p>
                {capture.title}
            </p>
        {/each}
    {/if}

    <Pagination data={data} bind:rows={captures}/>
</Content>
