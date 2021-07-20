<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller\InstallHandlers;

class PackagesConfigHandler extends AbstractConfigHandler
{
    public function getDestinationPath() : string
    {
        return M_PATH_CONFIG . 'packages/';
    }

    public function getSourceFileName() : string
    {
        return '/resources/install/package.php';
    }
}
