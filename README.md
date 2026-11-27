# Aquarius Web Project (V3)

> **V3.0.0** goes live on the official website at the public launch. Until then every version is a beta; the admin panel has run V3.0.0-beta2 since 25 Nov 2026.

## Versions

Each version is a git tag on its commit, so any version can be looked up or restored. Before launch: `v3.0.0-beta0` … `v3.0.0-beta3`. The launch is `v3.0.0`. After that, small fixes raise the last number (`v3.0.1`) and new features the middle one (`v3.1.0`).

## Tech Stack

| Technology | Version | Purpose |
|---|---|---|
| **Laravel** | 12 | PHP framework — routing, middleware, auth, backend logic |
| **Filament** | 4 | Admin panel & server-driven UI (SDUI) |
| **Livewire** | 3 | Full-stack reactive components |
| **Alpine.js** | 3 | Lightweight frontend interactivity |
| **Tailwind CSS** | 4 | Utility-first CSS framework |
| **Blade** | — | Laravel templating engine |

## Additional Dependencies

| Package | Purpose |
|---|---|
| **Filament Shield** | Role-based access control for admin panel |
| **Laravel Pint** | PHP code style formatter |
| **Laravel Pail** | Real-time log tailing |
| **Laravel Sail** | Docker-based local development |
| **Swiper.js** | Carousel/slider component |

## Changelog

### 2026-11-27 — V3.0.0-beta3
- Pages load faster: header photos load first, the homepage video is 1.0 MB (was 5.3 MB), and gallery tiles use small WebP copies (about 66 KB, was about 674 KB)
- New gallery uploads make their small copy automatically; `php artisan gallery:thumbnails` makes them for older photos
- Current-promotion badge is easier to read (dark text on orange)
- Slider arrows are round white buttons with hover and focus states
- The homepage video has a single Pause/Play control (the "Autoplay" label is gone)

### 2026-11-25 — V3.0.0-beta2 (live on the admin panel)
Admin fixes, live since 25 Nov:
- Gallery and project photos accept only JPEG, PNG, GIF and WebP
- Only an Admin can switch the Homepage, Contact Us and Privacy pages off
- Nobody can delete their own account or the last Admin
- Sessions from before a password change go back to the login page
- Added the `cache_locks` table the database cache needs
- Security updates: Laravel 12.74, Filament 4.17
- Emails come from "Aquarius Web" (enquiries) and "Aquarius Admin Panel" (admin); browser tabs read "Page - Aquarius Admin Panel"
- Admin uses the same fonts as the public site (Figtree and Outfit)

Public site, waiting for the launch:
- Error page buttons follow the page language; the gallery shows an error message and announces results
- Showcase section always links to Notable Projects

From 23 Nov (design clean-up and code audit):
- Homepage "Who we are" became a showroom section (address, hours, Get directions)
- Accessibility pass (WCAG 2.2 AA, axe 0 violations): skip link, labelled form fields, translated cookie notice, named landmarks
- One hover/press standard for every link, card, photo and pagination link
- Contact form checks fields in the browser; the server repeats the checks with the same translated messages
- Code audit (`code-audit.md`):
  - one page layout, one pool-page template, one pros/cons card
  - shared JS for scroll effects and AJAX pagination
  - dead classes, strings and unused images removed
- Fixed: project detail pages returned 404; homepage review numbers counted hidden reviews; English-only structured data on Malay pages

### 2026-06-18 — V3.0.0-beta1
- Replaced all inline SVG icons with Phosphor Icons across 23 Blade templates
- Updated icon viewBox from `0 0 24 24` to `0 0 256 256`, switched from stroke-based to fill-based rendering
- Brand icons (Facebook, Instagram, TikTok, WhatsApp, Google) and loading spinners kept unchanged

### 2026-04-16 — V3.0.0-beta0
- Upgraded Laravel 11 → 12
- Upgraded Tailwind CSS 3 → 4
- Upgraded Filament 3 → 4, Shield 3 → 4
- Migrated Preline interactive components to Alpine.js
- Redesigned footer with reusable components and CSS token refinements
- Refreshed image gallery UI with WCAG improvements
- UI polish: typography, color tokens, WCAG accessibility fixes
- Restyled comparison table, fixed fibreglass spelling
- Moved page-header to reusable component
- Installed Laravel Boost MCP tooling
