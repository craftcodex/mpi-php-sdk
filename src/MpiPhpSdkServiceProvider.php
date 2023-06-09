<?php

namespace CraftCodex\MpiPhpSdk;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MpiPhpSdkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('mpi-php-sdk')
            ->hasConfigFile('mitrapayment');
    }
}
