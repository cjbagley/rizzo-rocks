<nav x-data="{ open: false }">
    <div class="admin-nav">
        <div class="nav-container">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-nav-link>
            <x-nav-link :href="route('lookup.form')" :active="request()->routeIs('lookup.form')">
                {{ __('IGDB Lookup') }}
            </x-nav-link>
            <x-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')">
                {{ __('Games') }}
            </x-nav-link>
        </div>

        <div class="profile-container">
            <div>{{ Auth::user()->name }}</div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>
</nav>
