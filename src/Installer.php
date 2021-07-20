<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Package\PackageInterface;
use React\Promise\PromiseInterface;

use function in_array;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function install(
        InstalledRepositoryInterface $repository,
        PackageInterface $package
    ): PromiseInterface {
        $promise = parent::install($repository, $package);
        return $promise->then(
            function () use ($package) {
                $this->getEventManager()->install($package);
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function update(
        InstalledRepositoryInterface $repository,
        PackageInterface $initial,
        PackageInterface $target
    ): PromiseInterface {
        $promise = parent::update($repository, $initial, $target);
        return $promise->then(
            function () use ($initial, $target) {
                $this->getEventManager()->update($initial, $target);
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function uninstall(
        InstalledRepositoryInterface $repository,
        PackageInterface $package
    ): PromiseInterface {
        $promise = parent::uninstall($repository, $package);
        return $promise->then(
            function () use ($package) {
                $this->getEventManager()->uninstall($package);
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType): bool
    {
        return in_array(
            $packageType,
            [
                'mobicms-library',
                'mobicms-module',
                'mobicms-template',
            ]
        );
    }

    /**
     * @return InstallHandlerManager
     */
    private function getEventManager(): InstallHandlerManager
    {
        $manager = new InstallHandlerManager;
        $manager->attach(new InstallHandlers\PackagesConfigHandler($this));
        $manager->attach(new InstallHandlers\RoutesConfigHandler($this));
        $manager->attach(new InstallHandlers\PublicAssetsHandler($this));
        $manager->attach(new InstallHandlers\PublicDataHandler($this));

        return $manager;
    }
}
