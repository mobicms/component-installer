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
 * Class EventManager
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class InstallHandlerManager
{
    /**
     * @var \SplObjectStorage
     */
    private $storage;

    public function __construct()
    {
        $this->storage = new \SplObjectStorage();
    }

    /**
     * @param InstallHandlerInterface $handler
     */
    public function attach(InstallHandlerInterface $handler) : void
    {
        $this->storage->attach($handler);
    }

    /**
     * @param PackageInterface $package
     */
    public function install(PackageInterface $package) : void
    {
        foreach ($this->storage as $obj) {
            $obj->install($package);
        }
    }

    /**
     * @param PackageInterface $initial
     * @param PackageInterface $target
     */
    public function update(PackageInterface $initial, PackageInterface $target) : void
    {
        foreach ($this->storage as $obj) {
            $obj->update($initial, $target);
        }
    }

    /**
     * @param PackageInterface $package
     */
    public function uninstall(PackageInterface $package) : void
    {
        foreach ($this->storage as $obj) {
            $obj->uninstall($package);
        }
    }
}
