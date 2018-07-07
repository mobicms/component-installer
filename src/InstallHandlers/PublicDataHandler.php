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

use Composer\Package\PackageInterface;

/**
 * Class ProcessPublicData
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class PublicDataHandler extends AbstractDataHandler
{
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

    protected function getSourcePath(PackageInterface $package) : string
    {
        return (string) $this->installer->getInstallPath($package) . '/public/data/';
    }

    protected function getTargetPath() : string
    {
        return (string) MOBICMS_PUBLIC_DIR . 'data' . DIRECTORY_SEPARATOR;
    }
}
