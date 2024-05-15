<script>
    import Media from "../Components/Media.svelte";

    export let video;
</script>

<Media item={video}>
    <video height="200" controls controlslist="nodownload" disablepictureinpicture="true" playsinline="false">
        Your browser does not support video :(
        <source src="{video.url}" type="video/webm"/>
    </video>
</Media>

<style>
    video {
        margin: 0 auto;
        max-width: 100%;
    }
</style>
