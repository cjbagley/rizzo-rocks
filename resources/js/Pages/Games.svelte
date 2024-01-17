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
        <div
            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
        >
            {#each games as game}
                <GameLink {game} />
            {/each}
        </div>
    </Content>
</Layout>
