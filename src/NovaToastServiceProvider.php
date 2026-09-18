<?php

declare(strict_types=1);

namespace BBSLab\NovaToast;

use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NovaToastServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('nova-toast');
    }

    public function packageBooted(): void
    {
        Nova::serving(function (ServingNova $event): void {
            Nova::script('nova-toast', __DIR__.'/../resources/js/toast.js');
            Nova::provideToScript(['novaToast' => session(Toast::SESSION_KEY)]);
        });
    }
}
