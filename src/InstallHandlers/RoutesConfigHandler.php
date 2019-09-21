<?php

declare(strict_types=1);

/*
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

namespace Mobicms\ComponentInstaller\InstallHandlers;

class RoutesConfigHandler extends AbstractConfigHandler
{
    public function getDestinationPath() : string
    {
        return CMS_PATH_CONFIG . 'routes/';
    }

    public function getSourceFileName() : string
    {
        return '/install/config.routes.php';
    }
}
