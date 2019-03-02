<?php
/**
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

declare(strict_types=1);

namespace Mobicms\ComponentInstaller\InstallHandlers;

use Composer\Package\PackageInterface;

class PublicAssetsHandler extends AbstractDataHandler
{
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

    public function getSourcePath(PackageInterface $package) : string
    {
        return $this->installer->getInstallPath($package) . '/public/assets/';
    }

    public function getTargetPath() : string
    {
        return CMS_PATH_PUBLIC . 'assets' . DIRECTORY_SEPARATOR;
    }
}
