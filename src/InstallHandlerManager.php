<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller;

use Composer\Package\PackageInterface;

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
