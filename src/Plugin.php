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

namespace Mobicms\ComponentInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Class Plugin
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io) : void
    {
        $this->defineConstants(dirname(__DIR__, 4) . '/config/constants.php');
        $installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

    private function defineConstants($constantsFile) : void
    {
        if (is_file($constantsFile)) {
            require_once $constantsFile;
        } else {
            defined('MOBICMS_ROOT_DIR')
            || define('MOBICMS_ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);

            defined('MOBICMS_CONFIG_DIR')
            || define('MOBICMS_CONFIG_DIR', MOBICMS_ROOT_DIR . 'config' . DIRECTORY_SEPARATOR);

            defined('MOBICMS_PUBLIC_DIR')
            || define('MOBICMS_PUBLIC_DIR', MOBICMS_ROOT_DIR . 'www' . DIRECTORY_SEPARATOR);
        }
    }
}
