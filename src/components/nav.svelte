<script>
	import NavGithubLink from './nav-github-link.svelte';
	import NavLink from './nav-link.svelte';
	import NavMobileButton from './nav-mobile-button.svelte';
	import NavMobileProfile from './nav-mobile-profile.svelte';
	import NavProfileDropdown from './nav-profile-dropdown.svelte';
	import NavSiteLogo from './nav-site-logo.svelte';
</script>

<nav class="bg-red-800">
	<div class="mx-auto max-w-7xl px-10">
		<div class="flex h-16 items-center justify-between">
			<div class="flex items-center">
				<NavSiteLogo />
				<div class="hidden md:block">
					<div class="ml-10 flex items-baseline space-x-4">
						<NavLink>By Game</NavLink>
						<NavLink>Full List</NavLink>
					</div>
				</div>
			</div>
			<div class="hidden md:block">
				<div class="ml-4 flex items-center md:ml-6">
					<NavGithubLink />
					<!-- <NavProfileDropdown /> -->
				</div>
			</div>
			<div class="-mr-2 flex md:hidden">
				<NavMobileButton />
			</div>
		</div>
	</div>

	<!-- Mobile menu -->
	<div class="md:hidden" id="mobile-menu">
		<div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
			<NavLink>By Game</NavLink>
		</div>
		<!-- <NavMobileProfile /> -->
	</div>
</nav>
