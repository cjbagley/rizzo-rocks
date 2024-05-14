<script>
    import Content from "../Components/Content.svelte";

    export let item;
</script>

<Content>
    <div class="wrapper flex-column">
        <header>
            <h2 class="game-font">{item.title}</h2>
        </header>
        <slot/>
        <p>{item.comments}</p>
    </div>
</Content>

<style>
    header {
        text-align: center;
    }

    h2 {
        font-size: 24px;
    }

    .wrapper {
        row-gap: 20px;
    }
</style>
