<script>
    import {createEventDispatcher} from "svelte";
    import TagInput from "@/Components/TagInput.svelte";

    const dispatch = createEventDispatcher();

    // https://svelte.dev/repl/f55e23d0bf4b43b1a221cf8b88ef9904
    let timer;
    const debounce = v => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            let tagInputs = document.querySelectorAll('input[id^="tag_"]:checked');
            let tags = [];

            if (tagInputs.length > 0) {
                tagInputs.forEach((el, i) => {
                    tags.push(el.value);
                })
            }

            let newUrl = new URL(window.location.href);

            newUrl.searchParams.set('page', 1);
            newUrl.searchParams.set('search', document.querySelector('input[id="search"]').value);
            newUrl.searchParams.set('tags', tags.join("-"));

            window.history.replaceState(null, '', new URL(newUrl));
            dispatch('refresh', {url: newUrl});
        }, 750);
    }
    export let tags;
    export let term;
</script>

<form id="search-form" class="flex-column" on:submit|preventDefault>
    <div class="flex-column">
        <label for="search">Search:</label>
        <input id="search" value={term} type="search" title="Search"
               on:keyup={({ target: { value } }) => debounce(value)}
               on:change={({target: {value}}) => debounce(value)}
        >
    </div>

    {#if tags}
        <div class="flex-column">
            <legend>Tags:</legend>
            <div class="flex-row wrapper">
                {#each tags as tag}
                    <TagInput on:debounce={debounce} {tag}/>
                {/each}
            </div>
        </div>
    {/if}
</form>

<style>
    form {
        gap: 30px;
    }

    form > div {
        gap: 10px;
    }

    @media (width >= 640px) {
        form > div {
            flex-direction: row;
            gap: 0;
        }
    }

    legend, label {
        min-width: 80px;
    }

    .wrapper {
        column-gap: 20px;
        row-gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>
