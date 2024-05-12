<script>
    import Media from "../Components/Media.svelte";

    export let image;
</script>

<Media item={image}>
    <img src="{image.href}" alt="{image.title}" />
</Media>
