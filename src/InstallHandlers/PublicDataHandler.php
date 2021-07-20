<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller\InstallHandlers;

use Composer\Package\PackageInterface;

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

    public function getSourcePath(PackageInterface $package) : string
    {
        return $this->installer->getInstallPath($package) . '/public/data/';
    }

    public function getTargetPath() : string
    {
        return M_PATH_PUBLIC . 'data' . DIRECTORY_SEPARATOR;
    }
}
