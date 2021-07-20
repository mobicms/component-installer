<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller\InstallHandlers;

class RoutesConfigHandler extends AbstractConfigHandler
{
    public function getDestinationPath() : string
    {
        return M_PATH_CONFIG . 'routes/';
    }

    public function getSourceFileName() : string
    {
        return '/resources/install/routes.php';
    }
}
