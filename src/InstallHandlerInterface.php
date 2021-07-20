<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller;

use Composer\Package\PackageInterface;

interface InstallHandlerInterface
{
    public function install(PackageInterface $package) : void;

    public function update(PackageInterface $initial, PackageInterface $target) : void;

    public function uninstall(PackageInterface $package) : void;
}
