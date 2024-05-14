<script>
    import DarkModeToggle from "./DarkModeToggle.svelte";
    import NavGithubLink from "./NavGithubLink.svelte";
    import NavLink from "./NavLink.svelte";
    import NavMobileButton from "./NavMobileButton.svelte";
    import NavMobileProfile from "./NavMobileProfile.svelte";
    import NavProfileDropdown from "./NavProfileDropdown.svelte";
    import NavSiteLogo from "./NavSiteLogo.svelte";

    const navLinks = [
        {name: "By Game", href: "/browse/games"},
        {name: "Full List", href: "/browse/list"},
    ];
</script>

<nav>
    <div id="desktop-menu" class="flex-row">
        <div class="desktop-links-wrapper flex-row">
            <NavSiteLogo/>
            <div class="desktop-links">
                {#each navLinks as link}
                    <NavLink href={link.href}>{link.name}</NavLink>
                {/each}
            </div>
        </div>
        <div class="mobile-buttons">
            <NavMobileButton/>
        </div>
        <div class="mobile-buttons">
            <DarkModeToggle/>
            <NavGithubLink/>
        </div>
        <div class="desktop-buttons">
            <DarkModeToggle/>
            <NavGithubLink/>
        </div>
    </div>

    <div id="mobile-menu" class="hidden">
        {#each navLinks as link}
            <NavLink href={link.href}>{link.name}</NavLink>
        {/each}
    </div>
</nav>

<style>
    nav {
        background-color: #7f1d1d;
        margin-bottom: 30px;
    }

    #desktop-menu {
        margin-left: 12px;
        margin-right: 12px;
        max-width: 1280px;
        align-items: center;
        justify-content: space-between;
    }

    #desktop-menu > div {
        height: 64px;
    }

    @media (width >= 1280px) {
        #desktop-menu {
            margin-left: auto;
            margin-right: auto;
        }
    }

    .desktop-links {
        display: none;
        align-items: baseline;
    }

    .desktop-links-wrapper {
        align-items: center;
        min-width: 76px; /* Same width as right-hand btn containers */;
    }

    .mobile-buttons {
        display: flex;
        align-items: center;
    }

    @media (width >= 768px) {
        .desktop-links {
            display: flex;
        }

        .mobile-buttons {
            display: none;
        }
    }

    .desktop-buttons {
        display: none;
        align-items: center;
    }

    @media (width >= 768px) {
        .desktop-buttons {
            display: flex;
        }
    }

    #mobile-menu {
        display: flex;
        justify-content: space-evenly;
    }

    @media (width >= 768px) {
        #mobile-menu {
            display: none;
        }
    }
</style>
