<?php

namespace Vaweto\Medium;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vaweto\Medium\Commands\MediumCommand;

class MediumServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-medium')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_medium_table');
    }
}
