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
 * Class ProcessAssets
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class PublicAssetsHandler implements InstallHandlerInterface
{
    use FilesystemTrait;

    private $installer;
    private $publicPath;

    public function __construct(LibraryInstaller $installer)
    {
        $this->installer = $installer;
        $this->publicPath = MOBICMS_PUBLIC_DIR . 'assets' . DIRECTORY_SEPARATOR;
    }

    /**
     * @param PackageInterface $package
     */
    public function install(PackageInterface $package) : void
    {
        $this->uninstall($package);
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
        $this->deleteRecursive($this->publicPath . $package->getName());
    }

    private function copy(PackageInterface $package) : void
    {
        $sourcePath = $this->installer->getInstallPath($package) . '/public/assets/';

        if (is_dir($sourcePath)) {
            $this->copyRecursive($sourcePath, $this->publicPath . $package->getName());
        }
    }
}
