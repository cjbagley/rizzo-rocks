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
    <div>
        <span class="sr-only">20 captures available</span>
        <div class="badge">{game.capture_count}</div>
        <img width="238" height="300" src={game.cover} alt={game.title}/>
    </div>
</a>

<style>
    a {
        border-radius: 6px;
        width: 100%;
        display: flex;
        align-content: center;
        justify-content: center;
    }

    a:hover {
        opacity: 0.75;
    }

    a > div {
        position: relative;
        display: inline-flex;
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

    .badge {
        position: absolute;
        display: inline-flex;
        justify-content: center;
        background-color: #7f1d1d;
        border-radius: 20px;
        padding: 5px;
        color: #fff;
        top: -10px;
        inset-inline-end: -10px;
        font-size: 20px;
        line-height: 20px;
        width: 30px;
    }
</style>
