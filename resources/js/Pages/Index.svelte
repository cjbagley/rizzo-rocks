<script>
    import Content from "../Components/Content.svelte";

    export let appName;
</script>

<svelte:head>
    <title>{appName} - Home</title>
</svelte:head>

<Content header="{appName}">
    <div class="reading-padding flex-column">
        <p>Welcome to {appName}!</p>
        <p>What is it? It's a personal, hand-made site used to show off the Xbox captures I've taken over the years.</p>
        <p>It contains a mix of funny-things-that-happened, a side helping of cool-looking photos, topped off with a generous helping of me-screwing-over-my-friends-in-some-way (sorry Mike).</p>
        <p>It was also an excuse to try out Svelte, which morphed into using Svelte as the front end for a Laravel project. The GitHub icon in the top right will take you to the repo if you are interested in taking a look.</p>
    </div>
</Content>
<Content header="What's with this design?">
    <div class="reading-padding flex-column">
        <p>The first video game console I remember owning was the Sega Master System. This design is a homage to the box art style that it had.</p>
        <p>It also struck me that the Mega Drive box art is pretty much the same, just in black. That makes it perfect for a light/dark mode toggle, so I can pay homage to both! Go on, give it a try in the top right corner, you know you want to...</p>
    </div>
</Content>
