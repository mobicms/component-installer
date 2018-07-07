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
 * Class ComponentConfigHandler
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class ComponentConfigHandler extends AbstractConfigHandler
{
    protected function getDestinationPath() : string
    {
        return (string) MOBICMS_CONFIG_DIR . 'system/components/';
    }

    protected function getSourceFileName() : string
    {
        return (string) '/config/install.component.php';
    }
}
