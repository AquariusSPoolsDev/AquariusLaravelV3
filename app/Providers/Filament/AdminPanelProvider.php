<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\adminPanelMetadata;
use App\Filament\Widgets\ImageGalleryWidget;
use App\Filament\Widgets\PromotionsWidget;
use App\Filament\Widgets\ReviewsWidget;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->colors([
                'gray' => [
                    50 => 'oklch(0.970 0.008 240)',
                    100 => 'oklch(0.930 0.010 240)',
                    200 => 'oklch(0.870 0.013 240)',
                    300 => 'oklch(0.770 0.016 240)',
                    400 => 'oklch(0.660 0.018 240)',
                    500 => 'oklch(0.550 0.018 240)',
                    600 => 'oklch(0.450 0.016 240)',
                    700 => 'oklch(0.370 0.014 240)',
                    800 => 'oklch(0.300 0.012 240)',
                    900 => 'oklch(0.230 0.010 240)',
                    950 => 'oklch(0.160 0.008 240)',
                ],
                'primary' => [
                    50 => 'oklch(0.960 0.030 254)',
                    100 => 'oklch(0.920 0.065 254)',
                    200 => 'oklch(0.850 0.110 254)',
                    300 => 'oklch(0.760 0.155 254)',
                    400 => 'oklch(0.670 0.190 254)',
                    500 => 'oklch(0.590 0.215 254)',
                    600 => 'oklch(0.541 0.230 254)',
                    700 => 'oklch(0.460 0.210 254)',
                    800 => 'oklch(0.380 0.175 254)',
                    900 => 'oklch(0.290 0.135 254)',
                    950 => 'oklch(0.210 0.095 254)',
                ],
            ])
            ->unsavedChangesAlerts()
            ->favicon(asset('assets/favicon/favicon-16x16.png'))
            ->brandLogo(fn () => view('filament.components.logo'))
            ->brandLogoHeight('3rem')
            ->defaultThemeMode(ThemeMode::Light)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([])
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                // adminPanelMetadata::class,
                ImageGalleryWidget::class,
                PromotionsWidget::class,
                ReviewsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->assets([
                Css::make('custom-stylesheet', resource_path('css/app/custom-stylesheet.css')),
            ]);
    }
}
