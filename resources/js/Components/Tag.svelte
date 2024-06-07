<script>
    import TagSvg from "@/Components/TagSvg.svelte";

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
</style>
