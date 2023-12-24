<script>
    import { Link } from "@inertiajs/svelte";
    export let href = "";
</script>

<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
<!-- class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" -->
<Link
    {href}
    class="text-white dark:text-black hover:text-blue-900 rounded-md px-3 py-2 text-3xl font-bold"
    aria-current="page"
    ><slot />
</Link>
