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

namespace Mobicms\ComponentInstaller\InstallHandlers;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Mobicms\ComponentInstaller\InstallHandlerInterface;

/**
 * Class AbstractConfigHandler
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
abstract class AbstractConfigHandler implements InstallHandlerInterface
{
    protected $installer;

    public function __construct(LibraryInstaller $installer)
    {
        $this->installer = $installer;
    }

    /**
     * @param PackageInterface $package
     */
    public function install(PackageInterface $package) : void
    {
        $this->copy($package);
    }

    /**
     * @param PackageInterface $initial
     * @param PackageInterface $target
     */
    public function update(PackageInterface $initial, PackageInterface $target) : void
    {
        $this->uninstall($initial);
        $this->copy($target);
    }

    /**
     * @param PackageInterface $package
     */
    public function uninstall(PackageInterface $package) : void
    {
        $file = $this->getDestinationFileName($package);

        if (is_file($file)) {
            unlink($file);
        }
    }

    /**
     * @param PackageInterface $package
     */
    protected function copy(PackageInterface $package) : void
    {
        $file = $this->installer->getInstallPath($package)
            . '/' . ltrim($this->getSourceFileName(), '/');

        if (is_file($file)) {
            copy($file, $this->getDestinationFileName($package));
        }
    }

    /**
     * @param PackageInterface $package
     * @return string
     */
    protected function getDestinationFileName(PackageInterface $package) : string
    {
        return $this->getDestinationPath()
            . preg_replace('/[^a-z0-9]+/', '-', strtolower($package->getName()))
            . '.php';
    }

    abstract protected function getSourceFileName() : string;

    abstract protected function getDestinationPath() : string;
}