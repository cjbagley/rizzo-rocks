<script>
    import Content from "../Components/Content.svelte";

    export let video;
</script>

<Content>
    <div class="wrapper">
        <header>
            <h2 class="game-font">{video.title}</h2>
        </header>
        <video controls controlslist="nodownload" disablepictureinpicture="true" playsinline="false">
            Your browser does not support video :(
            <source src="{video.href}" type="video/webm"/>
        </video>
        <div>
            <p>{video.comments}</p>
        </div>
    </div>
</Content>

<style>
    header {
        text-align: center;
    }

    h2 {
        font-size: 24px;
    }

    video {
        margin: 0 auto;
        max-width: 100%;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        row-gap: 30px;
    }

</style>
