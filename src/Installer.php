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

use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Package\PackageInterface;

use function in_array;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function install(
        InstalledRepositoryInterface $repository,
        PackageInterface $package
    ) : void {
        parent::install($repository, $package);
        $this->getEventManager()->install($package);
    }

    /**
     * {@inheritDoc}
     */
    public function update(
        InstalledRepositoryInterface $repository,
        PackageInterface $initial,
        PackageInterface $target
    ) : void {
        parent::update($repository, $initial, $target);
        $this->getEventManager()->update($initial, $target);
    }

    /**
     * {@inheritDoc}
     */
    public function uninstall(
        InstalledRepositoryInterface $repository,
        PackageInterface $package
    ) : void {
        parent::uninstall($repository, $package);
        $this->getEventManager()->uninstall($package);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType) : bool
    {
        return in_array($packageType, [
            'mobicms-library',
            'mobicms-module',
            'mobicms-template',
        ]);
    }

    /**
     * @return InstallHandlerManager
     */
    private function getEventManager() : InstallHandlerManager
    {
        $manager = new InstallHandlerManager;
        $manager->attach(new InstallHandlers\ComponentConfigHandler($this));
        $manager->attach(new InstallHandlers\ModulesConfigHandler($this));
        $manager->attach(new InstallHandlers\PublicAssetsHandler($this));
        $manager->attach(new InstallHandlers\PublicDataHandler($this));

        return $manager;
    }
}
