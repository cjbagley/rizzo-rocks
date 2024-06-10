<script>
    import Tag from "@/Components/Tag.svelte";

    export let tags;
</script>

<form class="flex-column">
    <div class="flex-row">
        <label for="search">Search:</label>
        <input id="search" type="search" title="Search">
    </div>

    {#if tags}
        <div class="flex-row">
            <legend>Tags:</legend>
            <div class="flex-row wrapper">
                {#each tags as tag}
                    <div class="flex-row tag-input">
                        <input type="checkbox" id="tag_{tag.code}" name="tag_{tag.code}" checked>
                        <Tag {tag} tagLabel="tag_"/>
                    </div>
                {/each}
            </div>
        </div>
    {/if}
</form>

<style>
    form {
        gap: 20px;
    }

    legend, label {
        min-width: 80px;
    }

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

    input[type='checkbox'] {
        margin: 0;
    }
</style>
