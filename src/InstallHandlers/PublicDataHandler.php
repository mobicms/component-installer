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
 * Class ProcessPublicData
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class PublicDataHandler implements InstallHandlerInterface
{
    private $installer;
    private $publicPath;
    private $util;

    public function __construct(LibraryInstaller $installer)
    {
        $this->installer = $installer;
        $this->publicPath = MOBICMS_PUBLIC_DIR . 'data' . DIRECTORY_SEPARATOR;
        $this->util = new Filesystem;
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
        $this->copy($target);
    }

    /**
     * @param PackageInterface $package
     */
    public function uninstall(PackageInterface $package) : void
    {
        $this->util->removeDirectoryPhp($this->publicPath . $package->getName());
    }

    private function copy(PackageInterface $package)
    {
        $sourcePath = $this->installer->getInstallPath($package) . '/public/data/';

        if (is_dir($sourcePath)) {
            $this->util->copy($sourcePath, $this->publicPath . $package->getName());
        }
    }
}
