<script>
    import Content from "../Components/Content.svelte";

    export let videos;
</script>

<Content>
    <video controls>
        Your browser does not support video :(
        <source src="#" type="video/webm"/>
    </video>
</Content>
