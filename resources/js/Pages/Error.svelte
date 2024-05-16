<script>
    import Layout from "../Layouts/Layout.svelte";
    import Content from "../Components/Content.svelte";

    export let code;
    export let image;
</script>

<svelte:head>
    <title>Rizzo's Recollections</title>
</svelte:head>

<Layout>
    <Content header="Rizzo's Recollections">
        <p>Oh oh, something went wrong! Don't you hate when that happens? Let Colin know you got the following error
            code: {code}</p>
    </Content>
    <Content>
        <img src="{image}" alt="Grumpy Cat from Guecamelee 2">
    </Content>
</Layout>
