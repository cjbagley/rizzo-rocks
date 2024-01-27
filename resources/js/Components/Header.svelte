<script>
    export let header = "Rizzo's Recollections";
</script>

<header>
    <div class="header">
        <h1 class="game-font">
            {header}
        </h1>
    </div>
</header>

<style>
    .header {
        margin-left: auto;
        margin-right: auto;
        padding: 24px 8px;
        max-width: 1280px;
    }

    @media not all and (min-width: 640px) {
        .header {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media not all and (min-width: 1024px) {
        .header {
            padding-left: 32px;
            padding-right: 32px;
        }
    }

    .header h1 {
        color: #1e3a8a;
        font-size: 36px;
        line-height: 36px;
        text-align: center;
        overflow: auto;
    }

    @media not all and (min-width: 640px) {
        .header h1 {
            font-size: 64px;
        }
    }
</style>
