<script>
    import Content from "../Components/Content.svelte";

    export let appName;
    export let gameList;
</script>

<svelte:head>
    <title>{appName} - {gameList}</title>
</svelte:head>

<Content header={gameList}>{gameList}</Content>
