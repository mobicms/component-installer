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
 * Class ProcessConfig
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class ComponentConfigHandler extends AbstractConfigHandler
{
    /**
     * @param PackageInterface $package
     */
    protected function copy(PackageInterface $package) : void
    {
        $file = $this->installer->getInstallPath($package) . '/config/install.component.php';

        if (is_file($file)) {
            copy($file, $this->getDestinationName($package));
        }
    }

    /**
     * @param PackageInterface $package
     * @return string
     */
    protected function getDestinationName(PackageInterface $package) : string
    {
        return MOBICMS_CONFIG_DIR
            . 'system/components/'
            . preg_replace('/[^a-z0-9]+/', '-', strtolower($package->getName()))
            . '.php';
    }
}
