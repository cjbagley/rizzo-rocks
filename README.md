# RIZZO.ROCKS

![MIT Licence Badge](https://img.shields.io/badge/Licence-MIT-navy)
![Made with Laravel Badge](https://img.shields.io/badge/Laravel-Framework?style=flat&label=Made%20With&labelColor=58525B&color=F9322C)]
![Made with Svelte Badge](https://img.shields.io/badge/Svelte-Frontend?style=flat&label=Made%20With&labelColor=58525B&color=D43008)]
![Linting Badge](https://img.shields.io/badge/Pint-Linting?style=flat&label=Linting&labelColor=58525B&color=FFD000)]
![Static Check Badge](https://img.shields.io/badge/Larastan-Check?style=flat&label=Static%20Checker&labelColor=58525B&color=2563EB)]
![Automated Refactoring Badge](https://img.shields.io/badge/Rector-Refactoring?style=flat&label=Automated%20Refactoring&labelColor=58525B&color=59A35E)]

## What is it?

It's a personal, hand-made site used to show off the Xbox captures I've taken over the years.
It contains a mix of funny-things-that-happened, a side helping of cool-looking photos, topped off with a generous
helping of me-screwing-over-my-friends-in-some-way (sorry Mike).
It was also an excuse to try out Svelte, which morphed into using Svelte as the front end for a Laravel project.

## What's with the design?

The first video game console I remember owning was the Sega Master System, and the design is a homage to the box art
style it had.

It also struck me that the Mega Drive box art is pretty much the same, just in black, which made it perfect for a
light/dark mode toggle, so I can pay homage to both!

## Admin Note

To add/edit the games, captures, tags etc. I built a CRUD admin. I also created a 'game lookup' page that uses
the [IGDB API](https://www.igdb.com/api) to find details about a game and then can pre-fill the game 'create' form.
As this section is locked down, I've included screenshots below.

## Site Screenshots

|                                                 Master System Mode                                                  |                                                  Mega Drive Mode                                                  |
|:-------------------------------------------------------------------------------------------------------------------:|:-----------------------------------------------------------------------------------------------------------------:|
| ![Browse page in light mode](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719933904/browse-light_muwbko.png) | ![Browse page in dark mode](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719933904/browse-dark_t7aqdn.png) |
|   ![Game page in light mode](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719933904/game-light_vvkoso.png)   |   ![Game page in dark mode](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719933903/game-dark_pmmglx.png)   |
|   ![List page in light mode](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719933903/list-light_kcpgkk.png)   |   ![List page in dark mode](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719933903/list-dark_dbbdfj.png)   |

## Admin Screenshots

### Games Index

![Admin game list page](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719934244/admin-games_jnjov2.png)

### Game Capture Index

![Admin capture list page](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719934244/admin-captures_i2dsj5.png)

### [IGDB API](https://www.igdb.com/api) Lookup

![Admin game lookup page](https://res.cloudinary.com/dlrj5sbsg/image/upload/v1719934244/admin-lookup_xrsi5s.png)
