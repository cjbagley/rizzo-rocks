<script>
	import Header from '../components/header.svelte';
	import Nav from '../components/nav.svelte';
	import '../main.css';
</script>

<div class="background min-h-full">
	<Nav />
	<div
		class="bg-white border-2 rounded-lg border-black mt-10 mx-auto max-w-7xl py-6 sm:px-6 lg:px-8"
	>
		<Header />
		<main></main>
	</div>
</div>
