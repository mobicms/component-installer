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
use Composer\Util\Filesystem;
use Mobicms\ComponentInstaller\InstallHandlerInterface;

/**
 * Class AbstractDataHandler
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
abstract class AbstractDataHandler implements InstallHandlerInterface
{
    /**
     * @var LibraryInstaller
     */
    protected $installer;

    /**
     * @var Filesystem
     */
    protected $util;

    public function __construct(LibraryInstaller $installer)
    {
        $this->installer = $installer;
        $this->util = new Filesystem;
    }

    /**
     * @param PackageInterface $package
     */
    public function uninstall(PackageInterface $package) : void
    {
        $this->util->removeDirectoryPhp($this->getTargetPath() . $package->getName());
    }

    /**
     * @param PackageInterface $package
     */
    protected function copy(PackageInterface $package) : void
    {
        $sourcePath = $this->getSourcePath($package);

        if (is_dir($sourcePath)) {
            $this->util->copy($sourcePath, $this->getTargetPath() . $package->getName());
        }
    }

    /**
     * @param PackageInterface $package
     * @return string
     */
    abstract protected function getSourcePath(PackageInterface $package) : string;

    /**
     * @return string
     */
    abstract protected function getTargetPath() : string;
}
