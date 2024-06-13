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
        display: flex;
        gap: 5px;
        padding: 4px 8px;
        border-radius: 5px;
        color: #000000;
        font-size: 18px;
        line-height: 18px;
        font-weight: 500;
        flex-wrap: wrap;
    }

    .game-title {
        margin: 0 auto;
        padding: 0;
        color: #000;
    }

    :global(.dark-theme .game-title) {
        color: #fff !important;
    }
</style>
