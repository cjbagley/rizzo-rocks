<script>
    import {createEventDispatcher} from "svelte";

    // Hat tip to example at: https://svelte.dev/repl/84a8d64a6f1e49feba8f6a491ecc55f5?version=3.35.0
    // Was then able to build on that and make AJAX, with Laravel pagination endpoints
    export let rows;
    export let data;

    $: rows = data.data;
    $: perPage = data.per_page;
    $: totalRows = data.total;
    $: currentPage = data.current_page;
    $: from = data.from;
    $: to = data.to;
    $: nextUrl = data.next_page_url;
    $: prevUrl = data.prev_page_url;

    $: totalRows, currentPage = 0;
    $: currentPage, from, to, nextUrl, prevUrl;
    $: pageText = `${from} - ${to} of ${totalRows}`

    const dispatch = createEventDispatcher();

    function previous() {
        window.history.replaceState(null, '', new URL(prevUrl));
        dispatch('refresh', {url: prevUrl});
    }

    function next() {
        window.history.replaceState(null, '', new URL(nextUrl));
        dispatch('refresh', {url: nextUrl});
    }
</script>

{#if totalRows && totalRows > perPage}
    <div class='pagination flex-row'>
        <button on:click={previous}
                title="Load previous items"
                disabled={prevUrl == undefined ? true : false}
                aria-label="left arrow icon"
                aria-describedby="prev">
            <span id='prev' class='sr-only'>Load previous {perPage} items</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 aria-hidden="true"
                 focusable="false"
                 class="bi bi-caret-left-square-fill" viewBox="0 0 16 16">
                <path
                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm10.5 10V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4A.5.5 0 0 0 10.5 12"/>
            </svg>
        </button>
        <p class="text">{pageText}</p>
        <button on:click={next}
                disabled={nextUrl == undefined ? true : false}
                title="Load next items"
                aria-label="right arrow icon"
                aria-describedby="next">
            <span id='next' class='sr-only'>Load next {perPage} rows</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 aria-hidden="true"
                 focusable="false"
                 class="bi bi-caret-right-square-fill" viewBox="0 0 16 16">
                <path
                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4z"/>
            </svg>
        </button>
    </div>
{/if}

<style>
    .pagination {
        justify-content: flex-end;
        align-items: center;
    }

    .pagination .text {
        min-width: 150px;
        text-align: center;
    }
</style>
