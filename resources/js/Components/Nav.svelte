<script>
    import DarkModeToggle from "./DarkModeToggle.svelte";
    import NavGithubLink from "./NavGithubLink.svelte";
    import NavLink from "./NavLink.svelte";
    import NavMobileButton from "./NavMobileButton.svelte";
    import NavMobileProfile from "./NavMobileProfile.svelte";
    import NavProfileDropdown from "./NavProfileDropdown.svelte";
    import NavSiteLogo from "./NavSiteLogo.svelte";

    const navLinks = [
        { name: "By Game", href: "/browse/games" },
        { name: "Full List", href: "/browse/list" },
    ];
</script>

<nav>
    <div id="desktop-menu">
        <div class="desktop-links-wrapper">
            <NavSiteLogo />
            <div class="desktop-links">
                {#each navLinks as link}
                    <NavLink href={link.href}>{link.name}</NavLink>
                {/each}
            </div>
        </div>
        <div class="mobile-buttons">
            <DarkModeToggle />
            <NavGithubLink />
            <NavMobileButton />
        </div>
        <div class="desktop-buttons">
            <DarkModeToggle />
            <NavGithubLink />
        </div>
    </div>

    <div id="mobile-menu">
        {#each navLinks as link}
            <NavLink href={link.href}>{link.name}</NavLink>
        {/each}
    </div>
</nav>

<style>
    nav {
        background-color: #7f1d1d;
    }
    #desktop-menu {
        margin-left: 12px;
        margin-right: 12px;
        max-width: 1280px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    #desktop-menu > div {
        height: 64px;
    }
    @media (min-width: 1280px) {
        #desktop-menu {
            margin-left: auto;
            margin-right: auto;
        }
    }

    .desktop-links {
        display: none;
        margin-left: 16px;
        align-items: baseline;
    }

    .desktop-links-wrapper {
        display: flex;
        align-items: center;
    }

    .mobile-buttons {
        display: flex;
        margin-left: 20px;
        align-items: center;
    }
    @media (min-width: 768px) {
        .desktop-links {
            display: flex;
        }
        .mobile-buttons {
            display: none;
        }
    }

    .desktop-buttons {
        display: none;
        margin-left: 24px;
        align-items: center;
    }
    @media (min-width: 768px) {
        .desktop-buttons {
            display: flex;
        }
    }

    #mobile-menu {
        padding: 8px 8px 12px 8px;
        margin-top: 4px;
    }

    @media (min-width: 768px) {
        #mobile-menu {
            display: none;
        }
    }
</style>
