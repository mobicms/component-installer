<?php
/**
 * mobiCMS (https://mobicms.org/)
 * This file is part of mobiCMS Content Management System.
 *
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 * @copyright   Copyright (C) mobiCMS Community
 */

declare(strict_types=1);

namespace Mobicms\ComponentInstaller;

use Composer\Package\PackageInterface;

/**
 * Interface InstallerEventsInterface
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
interface InstallHandlerInterface
{
    public function install(PackageInterface $package) : void;

    public function update(PackageInterface $initial, PackageInterface $target) : void;

    public function uninstall(PackageInterface $package) : void;
}
