<script>
	import Header from '../components/header.svelte';
	export let header = '';
</script>

<main class="space-y-5 pt-10">
	{#if header}
		<div
			class="bg-white dark:bg-black border-2 rounded-lg border-black dark:border-white mx-3 xl:mx-auto max-w-7xl"
		>
			<Header {header} />
		</div>
	{/if}
	<div
		class="text-2xl bg-white dark:bg-black border-2 space-y-2 rounded-lg border-black dark:border-white p-3 mx-3 xl:mx-auto max-w-7xl"
	>
		<slot />
	</div>
</main>
