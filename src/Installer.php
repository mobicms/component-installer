<?php
/**
 * mobiCMS (https://mobicms.org/)
 * This file is part of mobiCMS Content Management System.
 *
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 * @copyright   Copyright (C) mobiCMS Community
 */

namespace Mobicms\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        switch ($package->getType()) {
            case 'mobicms-core':
                return 'mobicms/src/' . $package->getPrettyName();
                break;

            case 'mobicms-module':
                return 'modules/' . $package->getPrettyName();
                break;

            case 'mobicms-themes':
                return 'modules/' . $package->getPrettyName();
                break;

            default:
                $this->initializeVendorDir();
                $basePath = ($this->vendorDir ? $this->vendorDir . '/' : '') . $package->getPrettyName();
                $targetDir = $package->getTargetDir();

                return $basePath . ($targetDir ? '/' . $targetDir : '');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return $packageType == 'mobicms-core'
            || $packageType == 'mobicms-module'
            || $packageType == 'mobicms-theme';
    }
}
