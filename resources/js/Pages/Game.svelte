<script>
    import Layout from "../Layouts/Layout.svelte";
    import Content from "../Components/Content.svelte";
    import Video from "../Components/Video.svelte";
    import Image from "../Components/Image.svelte";
    export let game;
</script>

<svelte:head>
    <title>{game.title}</title>
</svelte:head>

<Layout>
    <Content header={game.title}>
        <div class="game-container">
            <div class="game-image-wrapper">
                <img
                    height="300"
                    width="175"
                    src={game.cover}
                    alt={game.title}
                />
            </div>
            <div class="game-details-wrapper">
                <div>
                    <p><strong>Played:&nbsp;</strong>{game.played_years}</p>
                    <p>{game.comments}</p>
                </div>
                <p>
                    <a href={game.igdb_url}>{game.igdb_url}</a>
                </p>
            </div>
        </div>
    </Content>

    <Video />
    <Image />
</Layout>

<style>
    .game-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin-top: 16px;
        margin-left: 16px;
    }
    .game-image-wrapper {
        margin: 0 auto;
    }
    .game-details-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .game-details-wrapper div {
        margin-top: 8px;
    }
    .game-details-wrapper a {
        color: #1e3a8a;
        font-size: 16px;
        line-height: 24px;
        text-decoration: solid #1e3a8a;
    }
    .game-details-wrapper a:hover {
        opacity: 0.8;
    }
    @media (width >= 1024px) {
        .game-container {
            flex-direction: row;
        }
    }
</style>
