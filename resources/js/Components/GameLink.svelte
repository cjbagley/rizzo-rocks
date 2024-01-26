<script>
    let grow = false;
    export let game;
</script>

<a
    href={game.page_url}
    class:grow
    on:mouseenter={() => (grow = true)}
    on:mouseleave={() => (grow = false)}
>
    <img src={game.cover} alt={game.title} />
</a>

<style>
    a {
        backdrop-filter: #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
        width: 100%;
    }
    a:hover {
        opacity: 0.75;
    }
    @media not all and (min-width: 1024px) {
        a {
            aspect-ratio: none;
        }
    }
    img {
        height: 100%;
        object-fit: cover;
        object-position: center;
        width: 100%;
    }
    .grow {
        transition: all 0.2s ease-in-out;
    }
    .grow:hover {
        transform: scale(1.1);
    }
</style>
