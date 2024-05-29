<script>
    import Content from "../Components/Content.svelte";

    export let code;
    export let image;
    export let appName;
</script>

<svelte:head>
    <title>{appName}</title>
</svelte:head>

<Content header="404 Not Found">
    <p>Oh oh, could not find the page you are looking for! </p>
</Content>
<Content>
    <img src="{image}" alt="Not found image - character posing from Fallout 4">
</Content>
