<script>
    import Media from "../Components/Media.svelte";

    export let image;

    function showOverlay(event) {
        let button = findButton(event.target);
        if (!button) {
            return;
        }

        let title = button.getAttribute('data-alt');
        let key = button.getAttribute('data-img');
        if (!key || !title) {
            return;
        }

        let overlay = createOverlay();
        let img = createImg(key, title);

        overlay.append(img);
        document.body.append(overlay);
        overlay.style.display = '';
    }

    function findButton(el) {
        if (el && String(el.tagName).toLowerCase() != 'button') {
            el = el.closest('button.image');
        }
        if (!el || !el.matches('button.image')) {
            return;
        }

        return el;
    }

    function createOverlay() {
        let overlay = document.createElement('div');
        overlay.classList.add('flex-column');
        overlay.classList.add('overlay');
        overlay.addEventListener('click', () => {
            closeOverlay();
        });
        overlay.addEventListener('keypress', () => {
            closeOverlay();
        });
        return overlay;
    }

    function createImg(key, alt) {
        let img = document.createElement('img');
        img.src = key;
        img.alt = alt;

        return img;
    }

    function closeOverlay() {
        for (const el of document.querySelectorAll('div.overlay')) {
            el.remove();
        }
    }

    let html = document.querySelector('html');
    html.addEventListener('keydown', () => {
        closeOverlay();
    });
</script>

<Media item={image} tags={image.tags ? image.tags : undefined}>
    <button class="image" aria-label="fullscreen image" data-alt="{image.title}" data-img="{image.url}"
            on:click|preventDefault={showOverlay}>
        <img height="200" src="{image.thumb}" alt="{image.title}" data-img="{image.url}"/>
        <div class="fullscreen-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                 class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707"/>
            </svg>
        </div>
    </button>
</Media>

<style>
    button {
        position: relative;
        background-color: transparent;
        border: none;
        margin: 0 auto;
    }

    .fullscreen-icon {
        position: absolute;
        bottom: 10px;
        right: 15px;
    }

    svg {
        color: white;
    }

    :global(.overlay) {
        background-color: black;
        background-color: rgba(0, 0, 0, 0.8);
        left: 0;
        top: 0;
        z-index: 99999;
        width: 100%;
        position: fixed;
        text-align: center;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
</style>
