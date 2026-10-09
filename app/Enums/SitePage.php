<?php

namespace App\Enums;

use App\Models\SiteSetting;

/**
 * Public pages that can be switched off from the admin panel's Page Visibility screen.
 * A hidden page returns 404 (in both languages) and drops out of sitemap.xml.
 * Links to it stay where they are and lead to the 404 page, except About Us and Projects,
 * whose links are also removed.
 */
enum SitePage: string
{
    case Homepage = 'homepage';
    case AboutUs = 'about_us';
    case OurPools = 'our_pools';
    case ConcretePools = 'concrete_pools';
    case VinylPools = 'vinyl_pools';
    case FibreglassPools = 'fibreglass_pools';
    case PoolServices = 'pool_services';
    case PoolItems = 'pool_items';
    case Showcase = 'showcase';
    case Projects = 'projects';
    case Reviews = 'reviews';
    case Promotions = 'promotions';
    case ContactUs = 'contact_us';
    case Faq = 'faq';
    case Terms = 'terms';
    case Privacy = 'privacy';
    case Sitemap = 'sitemap';

    public function label(): string
    {
        return match ($this) {
            self::Homepage => 'Homepage',
            self::AboutUs => 'About Us',
            self::OurPools => 'Our Pools (comparison)',
            self::ConcretePools => 'Concrete Pools',
            self::VinylPools => 'Vinyl Pools',
            self::FibreglassPools => 'Fibreglass Pools',
            self::PoolServices => 'Pool Services',
            self::PoolItems => 'Pool Items & Equipment',
            self::Showcase => 'Showcase Gallery',
            self::Projects => 'Notable Projects',
            self::Reviews => 'Customer Reviews',
            self::Promotions => 'Promotions',
            self::ContactUs => 'Contact Us',
            self::Faq => 'FAQ',
            self::Terms => 'Terms & Conditions',
            self::Privacy => 'Privacy Policy',
            self::Sitemap => 'Sitemap page',
        };
    }

    public function group(): string
    {
        return match ($this) {
            self::Homepage, self::AboutUs, self::ContactUs, self::Faq => 'Main pages',
            self::OurPools, self::ConcretePools, self::VinylPools, self::FibreglassPools => 'Our pools',
            self::PoolServices, self::PoolItems => 'Our services',
            self::Showcase, self::Projects, self::Reviews, self::Promotions => 'Our work & offers',
            self::Terms, self::Privacy, self::Sitemap => 'Legal & information',
        };
    }

    /**
     * Shown under each switch: what the page is, its address, and any side effect of hiding it.
     */
    public function description(): string
    {
        return match ($this) {
            self::Homepage => '/en · The main landing page with the hero video. Switching it off makes aquariusswimmingpools.com itself show "page not found".',
            self::AboutUs => '/en/about-us · Company story and showroom. Hiding it also removes its links from the menu, footer, homepage and Contact page.',
            self::OurPools => '/en/our-pools · Side-by-side comparison of concrete, vinyl and fibreglass pools.',
            self::ConcretePools => '/en/concrete-pools · Concrete pool build steps, pros and cons, and photos.',
            self::VinylPools => '/en/vinyl-pools · Vinyl pool build steps, pros and cons, and photos.',
            self::FibreglassPools => '/en/fibreglass-pools · Fibreglass pool build steps, pros and cons, and photos.',
            self::PoolServices => '/en/our-pool-services · Design and construction, repair and maintenance, renovation, equipment supply and after-sales service.',
            self::PoolItems => '/en/pool-items-equipments · Pumps, filters, chlorinators and pool chemicals.',
            self::Showcase => '/en/showcase · Photo gallery of finished pools, with search and tag filters.',
            self::Projects => '/en/projects · Featured projects, each with its own page. Hiding it also removes its links from the menu, footer and thank-you page.',
            self::Reviews => '/en/reviews · Published customer reviews, mostly from Google and Facebook.',
            self::Promotions => '/en/promotions · Current offers. The promotion banner at the top of the site links here.',
            self::ContactUs => '/en/contact-us · Contact form, phone numbers, address and opening hours. The contact form on the homepage keeps working.',
            self::Faq => '/en/faq · Frequently asked questions about pools and our services.',
            self::Terms => '/en/terms · Terms and conditions (English only). Linked from the footer.',
            self::Privacy => '/en/privacy · Privacy policy (English only). The contact form and cookie notice link here.',
            self::Sitemap => '/en/sitemap · List of every page for visitors. Separate from sitemap.xml, which is for Google.',
        };
    }

    /**
     * @return array<int, string>
     */
    public function routeNames(): array
    {
        return match ($this) {
            self::Homepage => ['homepage'],
            self::AboutUs => ['about-page'],
            self::OurPools => ['our-pools-main'],
            self::ConcretePools => ['concrete-pools-page'],
            self::VinylPools => ['vinyl-pools-page'],
            self::FibreglassPools => ['fibreglass-pools-page'],
            self::PoolServices => ['pool-services-page'],
            self::PoolItems => ['pool-items-page'],
            self::Showcase => ['pool-showcase-gallery'],
            self::Projects => ['projects-page', 'project-detail-page'],
            self::Reviews => ['customer-reviews-page'],
            self::Promotions => ['promo-page'],
            self::ContactUs => ['contact-page'],
            self::Faq => ['faq-page'],
            self::Terms => ['terms-page'],
            self::Privacy => ['privacy-page'],
            self::Sitemap => ['sitemap-page'],
        };
    }

    public static function forRoute(?string $routeName): ?self
    {
        foreach (self::cases() as $page) {
            if (in_array($routeName, $page->routeNames(), true)) {
                return $page;
            }
        }

        return null;
    }

    /**
     * Unfinished pages start hidden; everything else starts visible.
     */
    public function isVisibleByDefault(): bool
    {
        return ! in_array($this, [self::AboutUs, self::Projects], true);
    }

    public function settingKey(): string
    {
        return 'page_visibility.'.$this->value;
    }

    public function isVisible(): bool
    {
        return (bool) SiteSetting::getValue($this->settingKey(), $this->isVisibleByDefault());
    }

    public function setVisible(bool $isVisible): void
    {
        SiteSetting::setValue($this->settingKey(), $isVisible);
    }
}
