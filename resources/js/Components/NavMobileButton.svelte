<script>
    import {onMount} from "svelte";

    function toggleMobileMenu() {
        let isShowing = mobileMenuShowing();

        if (isShowing) {
            localStorage.mobilemenu = undefined;
            document.getElementById("mobile-menu").classList.add("hidden");
            return;
        }

        localStorage.mobilemenu = "true";
        document.getElementById("mobile-menu").classList.remove("hidden");
    }

    function mobileMenuShowing() {
        return localStorage.mobilemenu === 'true';
    }

    onMount(() => {
        if (mobileMenuShowing()) {
            document.getElementById("mobile-menu").classList.remove("hidden");
        }
    });
</script>

<!-- Mobile menu button -->
<button
    on:click={toggleMobileMenu}
    type="button"
    aria-controls="mobile-menu"
    aria-expanded="false"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list"
         viewBox="0 0 16 16">
        <path fill-rule="evenodd"
              d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
    </svg>
</button>

<style>
    button {
        background: none;
        border: none;
    }

    svg {
        color: #fff;
    }

    :global(.dark-theme) svg {
        color: #000;
    }
</style>
