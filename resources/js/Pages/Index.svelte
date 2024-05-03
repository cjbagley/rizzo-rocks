<script>
    import Layout from "../Layouts/Layout.svelte";
    import Content from "../Components/Content.svelte";
</script>

<svelte:head>
    <title>Rizzo's Recollections</title>
</svelte:head>

<main>
    <Layout>
        <Content header="Rizzo's Recollections">
            <p>Welcome!</p>
            <p>This is a site</p>
        </Content>
    </Layout>
</main>

<style>
    main {
        height: 100%;
    }
</style>
