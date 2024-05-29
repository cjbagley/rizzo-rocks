<script>
    import Content from "../Components/Content.svelte";

    export let code;
    export let image;
    export let appName;
</script>

<svelte:head>
    <title>{appName}</title>
</svelte:head>

<Content header="Oh no...">
    <p>Something went wrong! Don't you hate when that happens? Let Colin know you got the following error
        code: {code}</p>
</Content>
<Content>
    <img src="{image}" alt="Grumpy Cat from Guecamelee 2">
</Content>
