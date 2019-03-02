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

class ComponentConfigHandler extends AbstractConfigHandler
{
    protected function getDestinationPath() : string
    {
        return CMS_PATH_CONFIG . 'components/';
    }

    protected function getSourceFileName() : string
    {
        return '/install/config.component.php';
    }
}
