<script>
    // Hat tip to example at: https://svelte.dev/repl/84a8d64a6f1e49feba8f6a491ecc55f5?version=3.35.0
    // Was then able to build on that and make AJAX, with Laravel pagination endpoints
    export let rows;
    export let data;
    export let perPage;

    $: rows = data.data;
    $: totalRows = data.total;
    $: currentPage = data.current_page;
    $: totalPages = Math.ceil(totalRows / perPage);
    $: start = currentPage * perPage;
    $: end = currentPage === totalPages - 1 ? totalRows - 1 : start + perPage - 1;

    $: totalRows, currentPage = 0;
    $: currentPage, start, end;
</script>

{#if totalRows && totalRows > perPage}
    <div class='pagination'>
        <button on:click={() => currentPage -= 1}
                disabled={currentPage === 0 ? true : false}
                aria-label="left arrow icon"
                aria-describedby="prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-left-square-fill" viewBox="0 0 16 16">
                <path
                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm10.5 10V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4A.5.5 0 0 0 10.5 12"/>
            </svg>
        </button>
        <span id='prev' class='sr-only'>Load previous {perPage} rows</span>
        <p>{start + 1} - {end + 1} of {totalRows}</p>
        <button on:click={() => currentPage += 1}
                disabled={currentPage === totalPages - 1 ? true : false}
                aria-label="right arrow icon"
                aria-describedby="next">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-caret-right-square-fill" viewBox="0 0 16 16">
                <path
                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4z"/>
            </svg>
        </button>
        <span id='next' class='sr-only'>Load next {perPage} rows</span>
    </div>
{/if}
