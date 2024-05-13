<script>
    let grow = false;
    export let game;
</script>

<a
    href={game.url}
    class:grow
    on:mouseenter={() => (grow = true)}
    on:mouseleave={() => (grow = false)}
>
    <img width="240" height="300" src={game.cover} alt={game.title}/>
</a>

<style>
    a {
        border-radius: 6px;
        overflow: hidden;
        width: 100%;
        padding: 0 30px;
    }

    @media (width >= 640px) {
        a {
            padding: 0;
        }
    }

    a:hover {
        opacity: 0.75;
    }

    img {
        margin: 0 auto;
    }

    .grow {
        transition: all 0.2s ease-in-out;
    }

    .grow:hover {
        transform: scale(1.1);
    }
</style>
