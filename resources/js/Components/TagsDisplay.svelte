<script>
    import Tag from "@/Components/Tag.svelte";

    export let tags;
</script>


<div class="tag-wrapper">
    {#each tags as tag}
        <Tag {tag}/>
    {/each}
</div>

<style>
    .tag-wrapper {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: auto;
    }
</style>
