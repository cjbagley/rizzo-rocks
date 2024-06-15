<script>
    import Tag from "@/Components/Tag.svelte";
    import {createEventDispatcher} from "svelte";

    const dispatch = createEventDispatcher();

    export let tag;
    let checked = tag.is_selected ? 'checked' : '';

    function tagChange() {
        dispatch('debounce');
    }
</script>

<div class="flex-row tag-input">
    <input type="checkbox" id="tag_{tag.code}" name="tag_{tag.code}" value="{tag.code}" {checked}
           on:change={tagChange}
    >
    <Tag {tag} tagLabel="tag_"/>
</div>

<style>
    .tag-input {
        gap: 10px;
    }

    input[type='checkbox'] {
        margin: 0;
    }
</style>
