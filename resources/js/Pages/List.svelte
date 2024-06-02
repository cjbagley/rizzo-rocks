<script>
    import Content from "../Components/Content.svelte";
    import Pagination from "@/Components/Pagination.svelte";
    import Video from "@/Components/Video.svelte";
    import Image from "@/Components/Image.svelte";

    export let appName;
    export let gameList;

    let captures;
    export let data;
</script>

<svelte:head>
    <title>{appName} - {gameList}</title>
</svelte:head>

<Content header={gameList}>
    <Pagination data={data} bind:rows={captures}/>
    {#if captures}
        <div class="grid">
            {#each captures as capture}
                {#if capture.type == 'video' }
                    <Video video={capture}/>
                {/if}

                {#if capture.type == 'image' }
                    <Image image={capture}/>
                {/if}
            {/each}
        </div>
    {/if}

</Content>
