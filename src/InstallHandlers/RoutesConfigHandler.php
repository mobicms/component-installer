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

/**
 * Class RoutesConfigHandler
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class RoutesConfigHandler extends AbstractConfigHandler
{
    protected function getDestinationPath() : string
    {
        return CMS_PATH_CONFIG . 'routes/';
    }

    protected function getSourceFileName() : string
    {
        return '/install/config.routes.php';
    }
}
