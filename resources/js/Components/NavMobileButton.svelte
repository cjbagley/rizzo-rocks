<script>
    function toggleMobileMenu() {
        document.getElementById("mobile-menu").classList.toggle("hidden");
    }
</script>

<!-- Mobile menu button -->
<button
    on:click={toggleMobileMenu}
    type="button"
    aria-controls="mobile-menu"
    aria-expanded="false"
>
    <span class="sr-only">Open main menu</span>
    <svg
        class="block"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        aria-hidden="true"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
        />
    </svg>
    <svg
        class="hidden"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        aria-hidden="true"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
        />
    </svg>
</button>

<style>
    button {
        align-items: center;
        background-color: #000;
        border-radius: 6px;
        color: #fff;
        display: inline-flex;
        justify-content: center;
        padding: 8px;
        position: relative;
    }

    svg {
        height: 24px;
        width: 24px;
    }
</style>
