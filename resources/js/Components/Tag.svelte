<script>
    import TagSvg from "@/Components/TagSvg.svelte";
    import GameSvg from "@/Components/GameSvg.svelte";

    export let tag;
    export let tagLabel = '';
</script>

{#if tagLabel != ''}
    <label for="{tagLabel}{tag.code}">
        <span style="background-color: {tag.colour}">
            <TagSvg/>
            {tag.tag}
        </span>
    </label>
{:else if tag.icon == 'game'}
    <span class="game-title">
        <GameSvg/>
        {tag.tag}
    </span>
{:else}
    <span style="background-color: {tag.colour}">
        <TagSvg/>
        {tag.tag}
    </span>
{/if}

<style>
    span {
        align-items: center;
        border-radius: 5px;
        color: #000000;
        display: flex;
        flex-wrap: wrap;
        font-size: 18px;
        font-weight: 500;
        gap: 5px;
        line-height: 18px;
        padding: 4px 8px;
    }

    .game-title {
        color: #000;
        gap: 10px;
        flex-wrap: nowrap;
        margin: 0 auto;
        padding: 0;
    }

    :global(.dark-theme .game-title) {
        color: #fff !important;
    }
</style>
