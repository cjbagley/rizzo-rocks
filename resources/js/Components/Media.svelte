<script>
    import Content from "../Components/Content.svelte";
    import Tags from "@/Components/TagsDisplay.svelte";
    import Tag from "@/Components/Tag.svelte";

    export let item;
    export let tags;
</script>

<Content>

    <div class="wrapper flex-column">
        <slot/>
        <header>
            <h2 class="game-font">{item.title}</h2>
        </header>
        <p>{item.comments}</p>
        {#if (tags) }
            <Tags tags="{tags}"/>
        {/if}
        {#if item.game}
            <Tag tag={{tag: item.game, icon: 'game'}}/>
        {/if}
    </div>
</Content>

<style>
    header {
        text-align: center;
    }

    h2 {
        font-size: 26px;
        font-weight: normal;
    }

    .wrapper {
        row-gap: 20px;
        height: 100%;
    }
</style>
