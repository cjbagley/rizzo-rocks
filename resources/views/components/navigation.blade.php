<nav x-data="{ open: false }">
    <div class="admin-nav">
        <div class="nav-container">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('app.dashboard.name') }}
            </x-nav-link>
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('app.profile') }}
            </x-nav-link>
            <x-nav-link :href="route('lookup.form')" :active="request()->routeIs('lookup.form')">
                {{ __('app.igdb_lookup') }}
            </x-nav-link>
            <x-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')">
                {{ __('app.games') }}
            </x-nav-link>
            <x-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')">
                {{ __('app.tags') }}
            </x-nav-link>
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
