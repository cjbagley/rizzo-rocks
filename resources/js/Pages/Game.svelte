<script>
    import Content from "../Components/Content.svelte";
    import Video from "../Components/Video.svelte";
    import Image from "../Components/Image.svelte";

    export let game;
    export let videos;
    export let images;
</script>

<svelte:head>
    <title>{game.title}</title>
</svelte:head>

<Content header={game.title}>
    <div class="game-container">
        <div class="game-image-wrapper">
            <img width="240" height="300" src={game.cover} alt={game.title}/>
        </div>
        <div class="game-details-wrapper flex-column">
            <div class="game-details flex-column">
                <p><strong>Played:&nbsp;</strong>{game.played_years}</p>
                <p>{game.comments}</p>
            </div>
            <p>
                <a target="_new" rel="noreferrer" href={game.igdb_url}>{game.igdb_url}</a>
            </p>
        </div>
    </div>
</Content>

{#if (videos || images) }
    <div class="grid">
        {#if (videos) }
            {#each videos as video}
                <Video {video}/>
            {/each}
        {/if}

        {#if (images) }
            {#each images as image}
                <Image {image}/>
            {/each}
        {/if}
    </div>
{/if}

<style>
    .game-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .game-image-wrapper {
        margin: 0 auto;
    }

    .game-details-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 20px;
    }

    .game-details {
        gap: 10px;
    }

    .game-details-wrapper a {
        font-size: 18px;
    }

    .game-details-wrapper a:hover {
        opacity: 0.8;
    }

    @media (width >= 1024px) {
        .game-container {
            grid-template-columns: 1fr 4fr;
        }
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 24px;
        max-width: 1280px;
    }

    .grid :global(.card) {
        margin: 0;
    }

    @media (width >= 800px) {
        .grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (width >= 1200px) {
        .grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
</style>
