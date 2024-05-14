<script>
    import Media from "../Components/Media.svelte";

    export let image;
</script>

<Media item={image}>
    <img data-img="{image.url}" src="{image.thumb}" alt="{image.title}"/>
</Media>
