<script>
    import Tag from "@/Components/Tag.svelte";

    export let tags;
</script>

<form>
    <div>
        <label for="search">Search:</label>
        <input id="search" type="search" title="HERE">
    </div>

    {#if tags}
        <fieldset>
            <lengend>Tags:</lengend>
            <div class="flex-row wrapper">
                {#each tags as tag}
                    <div class="flex-row tag-input">
                        <input type="checkbox" id="tag_{tag.id}" name="tag_{tag.id}" checked>
                        <label class="sr-only" for="tag_{tag.id}">{tag.tag}</label>
                        <Tag {tag}/>
                    </div>
                {/each}
            </div>
        </fieldset>
    {/if}
</form>

<style>

    fieldset {
        border: none;
        padding: 0;
    }

    .wrapper {
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .tag-input {
        gap: 10px;
    }
</style>
