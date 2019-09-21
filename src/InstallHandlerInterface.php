<?php

declare(strict_types=1);

/*
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

namespace Mobicms\ComponentInstaller;

use Composer\Package\PackageInterface;

interface InstallHandlerInterface
{
    public function install(PackageInterface $package) : void;

    public function update(PackageInterface $initial, PackageInterface $target) : void;

    public function uninstall(PackageInterface $package) : void;
}
