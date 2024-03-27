<script>
    export let header = "Rizzo's Recollections";
</script>

<header class="game-font">
    {header}
</header>

<style>
    header {
        color: #1e3a8a;
        font-size: 32px;
        line-height: initial;
        overflow: auto;
        padding: 12px 0;
        text-align: center;
        text-rendering: geometricPrecision;
    }

    @media (width >= 640px) {
        header {
            font-size: 52px;
        }
    }

    @media (width >= 768px) {
        header {
            font-size: 52px;
        }
    }
    @media (width >= 1024px) {
        header {
            font-size: 64px;
        }
    }
</style>
