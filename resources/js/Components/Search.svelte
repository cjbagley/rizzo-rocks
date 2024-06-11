<script>
    import Tag from "@/Components/Tag.svelte";
    import {createEventDispatcher} from "svelte";


    const dispatch = createEventDispatcher();

    // https://svelte.dev/repl/f55e23d0bf4b43b1a221cf8b88ef9904
    let timer;
    const debounce = v => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let newUrl = new URL(window.location.href);

            newUrl.searchParams.set('page', 1);
            newUrl.searchParams.set('search', v);

            window.history.replaceState(null, '', new URL(newUrl));
            dispatch('refresh', {url: newUrl});
        }, 750);
    }
    export let tags;
</script>

<form class="flex-column">
    <div class="flex-row">
        <label for="search">Search:</label>
        <input id="search" type="search" title="Search" on:keyup={({ target: { value } }) => debounce(value)}>
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
