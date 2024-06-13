<script>
    import Content from "../Components/Content.svelte";
    import Pagination from "@/Components/Pagination.svelte";
    import Video from "@/Components/Video.svelte";
    import Image from "@/Components/Image.svelte";
    import Search from "@/Components/Search.svelte";

    export let appName;
    export let gameList;
    export let noResults;

    let captures;
    export let data;
    const meta = document.querySelectorAll('meta[name="csrf-token"]');
    let searchTerm = data.search ? data.search : '';

    async function refresh(e) {
        try {
            if (!e.detail || !e.detail.url) {
                throw new Error("Error loading response");
            }

            const response = await fetch(e.detail.url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': meta.length > 0 ? meta[0].content : '',
                },
            });

            if (!response.ok) {
                throw new Error("Error loading response");
            }

            data = await response.json();
            window.scrollTo({top: 0, behavior: 'smooth'});
        } catch (e) {
            // Fallback, just reload the correct page instead of AJAX
            window.location.reload();
        }
    }

</script>

<svelte:head>
    <title>{appName} - {gameList}</title>
</svelte:head>

<Content header={gameList}>
    <Content>
        <Search on:refresh={refresh} tags={data.tags} term={searchTerm}/>
    </Content>
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
    {:else }
        <Content>
            {noResults}
        </Content>
    {/if}
    <Pagination on:refresh={refresh} data={data.data} bind:rows={captures} bind:captures={captures}/>
</Content>
