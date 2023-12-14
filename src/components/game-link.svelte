<script>
	let grow = false;
</script>

<div
	class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80"
	class:grow
	on:mouseenter={() => (grow = true)}
	on:mouseleave={() => (grow = false)}
>
	<img
		src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg"
		alt="Front of men&#039;s Basic Tee in black."
		class="h-full w-full object-cover object-center lg:h-full lg:w-full"
	/>
</div>

<style>
	.grow {
		transition: all 0.2s ease-in-out;
	}
	.grow:hover {
		transform: scale(1.1);
	}
</style>
