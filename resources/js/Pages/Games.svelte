<script>
    import Layout from "../Layouts/Layout.svelte";
    import Content from "../Components/Content.svelte";
    import GameLink from "../Components/GameLink.svelte";
    export let games;
</script>

<svelte:head>
    <title>Browse Games</title>
</svelte:head>

<Layout>
    <Content header="Browse Games">
        <div class="games-wrapper">
            {#each games as game}
                <GameLink {game} />
            {/each}
        </div>
    </Content>
</Layout>

<style>
    .games-wrapper {
        column-gap: 24px;
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        row-gap: 40px;
    }
    @media (min-width: 640px) {
        .games-wrapper {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (min-width: 1024px) {
        .games-wrapper {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }
    @media (min-width: 1280px) {
        .games-wrapper {
            grid-template-columns: repeat(8, minmax(0, 1fr));
        }
    }
</style>
