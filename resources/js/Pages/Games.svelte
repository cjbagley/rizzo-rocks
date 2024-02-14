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
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 24px;
    }
    @media (width >= 500px) {
        .games-wrapper {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (width >= 640px) {
        .games-wrapper {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
    @media (width >= 1024px) {
        .games-wrapper {
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }
    }
</style>
