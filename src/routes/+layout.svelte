<script>
	import Header from '../components/header.svelte';
	import Nav from '../components/nav.svelte';
	import '../main.css';
</script>

<div class="background min-h-full">
	<Nav />
	<div
		class="bg-white dark:bg-black border-2 rounded-lg border-black dark:border-white mt-10 mx-auto max-w-7xl py-6 sm:px-6 lg:px-8"
	>
		<Header />
		<main></main>
	</div>
</div>
