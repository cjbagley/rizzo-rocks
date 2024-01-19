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
        <div class="flex flex-col lg:flex-row w-full space-y-4 space-x-4">
            <div class="mx-auto my-0">
                <img
                    height="300"
                    width="175"
                    src={game.cover}
                    alt={game.title}
                />
            </div>
            <div class="flex flex-col justify-between">
                <div class="space-y-2">
                    <p><strong>Played:&nbsp;</strong>{game.played_years}</p>
                    <p>{game.comments}</p>
                </div>
                <p>
                    <a
                        class="text-base text-blue-600 underline decoration-blue-500 hover:opacity-80"
                        href={game.igdb_url}>{game.igdb_url}</a
                    >
                </p>
            </div>
        </div>
    </Content>

    <Video />
    <Image />
</Layout>
