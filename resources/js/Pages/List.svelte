<script>
    import Content from "../Components/Content.svelte";
    import Pagination from "@/Components/Pagination.svelte";

    export let appName;
    export let gameList;

    let values;
    export let games;
</script>

<svelte:head>
    <title>{appName} - {gameList}</title>
</svelte:head>

<Content header={gameList}>
    {#if values}
        {#each values as value}
            <p>
                {value.title}
            </p>
        {/each}
    {/if}

    <Pagination data={games} perPage={games.per_page} bind:rows={values}/>

</Content>
