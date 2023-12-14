<script>
	import Content from '../../../components/content.svelte';
	import GameImage from '../../../components/game-image.svelte';
</script>

<svelte:head>
	<title>Browse Games</title>
</svelte:head>

<Content header="Browse Games">
	<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
		<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
			<GameImage />
			<GameImage />
			<GameImage />
			<GameImage />
			<GameImage />
		</div>
	</div>
</Content>
