<script>
    import Media from "../Components/Media.svelte";

    export let image;
</script>

<Media item={image}>
    <img on:click|once={showOverlay} src="{image.url}" alt="{image.title}"/>
</Media>
