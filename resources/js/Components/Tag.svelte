<script>
    import TagSvg from "@/Components/TagSvg.svelte";
    import GameSvg from "@/Components/GameSvg.svelte";

    export let tag;
    export let tagLabel = '';
</script>

{#if tagLabel != ''}
    <label for="{tagLabel}{tag.code}">
        <span class="tag" style="background-color: {tag.colour}">
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
    <span class="tag" style="background-color: {tag.colour}">
        <TagSvg/>
        {tag.tag}
    </span>
{/if}

<style>
    .tag {
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
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        text-align: center;
    }

    :global(.game-title > svg) {
        margin-right: 8px;
    }

    :global(.dark-theme .game-title) {
        color: #fff !important;
    }
</style>
