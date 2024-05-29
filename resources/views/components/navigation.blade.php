<nav x-data="{ open: false }">
    <div class="admin-nav">
        <div class="nav-container">
            <x-admin-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('app.dashboard.name') }}
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('app.profile') }}
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('lookup.form')" :active="request()->routeIs('lookup.form')">
                {{ __('app.igdb_lookup') }}
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')">
                {{ __('app.games') }}
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.index')">
                {{ __('app.tags') }}
            </x-admin-nav-link>
        </div>

        <div class="profile-container">
            <p>{{ Auth::user()->name }}</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('app.logout') }}
                </a>
            </form>
        </div>
    </div>
</nav>
