<script>
    import Layout from "../Layouts/Layout.svelte";
    import Content from "../Components/Content.svelte";

    export let appName;
</script>

<svelte:head>
    <title>{appName}</title>
</svelte:head>

<Layout>
    <Content header="{appName}">
        <p>Welcome to {appName}!</p>
        <p>This is a personal site used to show off some of the Xbox captures I've
            taken over the years, now that they are being removed from the Xbox network.</p>
        <p>I also wanted an excuse to try out Svelte, which eventually morphed into using it as the front-end for a
            Laravel project.</p>
        <p>Explore the site either 'By Game', which displays the different games there are captures for, or 'Full list',
            which has a table of the captures available for each game.</p>
    </Content>
    <Content header="What's with this design?">
        <p>Well, some of the first video game consoles I remember playing are the Sega Master System, and the Sega Mega
            Drive. This design is an homage to the box art style that they both had, and it struck me that the white of
            the Master System and the black of the Mega Drive would be perfect for a light/dark mode toggle. Go on, give
            it a try in the top right corner!</p>
    </Content>
</Layout>
