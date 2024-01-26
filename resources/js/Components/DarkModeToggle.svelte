<script>
    /*
     * Note - as much as I didn't want to, I had to duplicate a little bit of this code in the
     * app.html head, to stop Flash Of Colour on load. Could not find a way to do it with
     * svelte, and I spent way to long trying vs. how important this is.
     */

    import { onMount } from "svelte";

    const DARK_THEME = "dark-theme";
    const LIGHT_THEME = "light-theme";

    function getAppliedTheme() {
        return document
            .getElementsByTagName("html")[0]
            .classList.contains(DARK_THEME)
            ? DARK_THEME
            : LIGHT_THEME;
    }

    function toggleSiteTheme() {
        let newTheme =
            getAppliedTheme() == LIGHT_THEME ? DARK_THEME : LIGHT_THEME;

        localStorage.theme = newTheme;
        applySiteTheme(newTheme);
    }

    function applySiteTheme(theme) {
        if (theme == LIGHT_THEME) {
            document
                .getElementsByTagName("html")[0]
                .classList.remove(DARK_THEME);
            document
                .querySelectorAll(".dark-mode-icon")
                .forEach((el) => el.classList.add("hidden"));
            document
                .querySelectorAll(".light-mode-icon")
                .forEach((el) => el.classList.remove("hidden"));
        } else {
            document.getElementsByTagName("html")[0].classList.add(DARK_THEME);
            document
                .querySelectorAll(".dark-mode-icon")
                .forEach((el) => el.classList.remove("hidden"));
            document
                .querySelectorAll(".light-mode-icon")
                .forEach((el) => el.classList.add("hidden"));
        }
    }

    onMount(() => {
        applySiteTheme(getAppliedTheme());
    });
</script>

<button id="dark-mode-toggle" on:click={toggleSiteTheme}>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="35"
        height="35"
        fill="currentColor"
        class="light-mode-icon"
        viewBox="0 0 16 16"
    >
        <path
            d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"
        />
    </svg>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="30"
        height="30"
        fill="currentColor"
        class="dark-mode-icon"
        viewBox="0 0 16 16"
    >
        <path
            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278"
        />
    </svg>
</button>

<style>
    button {
        background: none;
        border: none;
    }
    .light-mode-icon {
        color: #fff;
    }
    .dark-mode-icon {
        color: #000;
    }
</style>
