<script>
    let grow = false;
    export let game;
</script>

<div
    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75"
    class:grow
    on:mouseenter={() => (grow = true)}
    on:mouseleave={() => (grow = false)}
>
    <img
        src={game.cover}
        alt={game.title}
        class="h-full w-full object-cover object-center lg:h-full lg:w-full"
    />
</div>

<style>
    .grow {
        transition: all 0.2s ease-in-out;
    }
    .grow:hover {
        transform: scale(1.1);
    }
</style>
