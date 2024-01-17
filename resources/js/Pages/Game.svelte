<script>
    import Layout from "../Layouts/Layout.svelte";
    import Content from "../Components/Content.svelte";
    export let game;
</script>

<svelte:head>
    <title>{game.title}</title>
</svelte:head>

<Layout>
    <Content header={game.title}></Content>
</Layout>
