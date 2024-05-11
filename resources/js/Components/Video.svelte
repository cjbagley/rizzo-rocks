<script>
    import Content from "../Components/Content.svelte";

    export let video;
</script>

<Content>
    <div class="wrapper">
        <video controls controlslist="nodownload" disablepictureinpicture="true" playsinline="false">
            Your browser does not support video :(
            <source src="{video.href}" type="video/webm"/>
        </video>
        <div>
            <h2>{video.title}</h2>
            <p>{video.comments}</p>
        </div>
    </div>
</Content>

<style>
    .wrapper {
        display: flex;
        flex-direction: column-reverse;
    }

    video {
        margin: 0 auto;
        max-width: 500px;
    }

    @media (width >= 1024px) {
        .wrapper {
            flex-direction: row;
            column-gap: 20px;
        }
    }

    p {
        margin: 10px 0;
    }
</style>
