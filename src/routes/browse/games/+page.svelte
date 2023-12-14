<script>
	import Content from '../../../components/content.svelte';
	import GameLink from '../../../components/game-link.svelte';
</script>

<svelte:head>
	<title>Browse Games</title>
</svelte:head>

<Content header="Browse Games">
	<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
		<GameLink />
		<GameLink />
	</div>
</Content>
