<?php

declare(strict_types=1);

namespace Mobicms\ComponentInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

use function is_file;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->defineConstants();
        $installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    private function defineConstants(): void
    {
        $constantsFile = dirname(__DIR__, 4) . '/config/constants.php';

        if (is_file($constantsFile)) {
            require_once $constantsFile;
        } else {
            defined('M_PATH_ROOT') || define('M_PATH_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
            defined('M_PATH_CONFIG') || define('M_PATH_CONFIG', M_PATH_ROOT);
            defined('M_PATH_PUBLIC') || define('M_PATH_PUBLIC', M_PATH_ROOT);
        }
    }
}
