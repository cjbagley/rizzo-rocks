<script>
    import Layout from "../Layouts/Layout.svelte";
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

<Layout>
    <Content header={game.title}>
        <div class="game-container">
            <div class="game-image-wrapper">
                <img width="200" src={game.cover} alt={game.title}/>
            </div>
            <div class="game-details-wrapper">
                <div class="game-details">
                    <p><strong>Played:&nbsp;</strong>{game.played_years}</p>
                    <p>{game.comments}</p>
                </div>
                <p>
                    <a href={game.igdb_url}>{game.igdb_url}</a>
                </p>
            </div>
        </div>
    </Content>

    {#each videos as video}
        <Video {video}/>
    {/each}

    {#each images as image}
        <Image/>
    {/each}
</Layout>

<style>
    .game-container {
        display: grid;
        grid-template-columns: 1fr;
        row-gap: 20px;
    }

    .game-image-wrapper {
        margin: 0 auto;
    }

    .game-details-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .game-details {
        display: flex;
        flex-direction: column;
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
</style>
