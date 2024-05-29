<script>
    import {inertia} from "@inertiajs/svelte";

    let grow = false;
    export let game;
</script>

<a
    use:inertia
    href={game.url}
    class:grow
    on:mouseenter={() => (grow = true)}
    on:mouseleave={() => (grow = false)}
>
    <img width="238" height="300" src={game.cover} alt={game.title}/>
</a>

<style>
    a {
        border-radius: 6px;
        overflow: hidden;
        width: 100%;
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
