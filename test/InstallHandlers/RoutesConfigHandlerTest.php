<?php

declare(strict_types=1);

/*
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

namespace MobicmsTest\System\InstallHandlers;

use Composer\Installer\LibraryInstaller;
use Mobicms\ComponentInstaller\InstallHandlers\ModulesConfigHandler;
use PHPUnit\Framework\TestCase;

class RoutesConfigHandlerTest extends TestCase
{
    public function testGetSourceFileName()
    {
        $installer = $this->prophesize(LibraryInstaller::class);
        $handler = new ModulesConfigHandler($installer->reveal());
        $this->assertStringEndsWith('config.routes.php', $handler->getSourceFileName());
    }

    public function testGetDestinationPath()
    {
        $installer = $this->prophesize(LibraryInstaller::class);
        $handler = new ModulesConfigHandler($installer->reveal());
        $this->assertStringEndsWith('modules/', $handler->getDestinationPath());
    }
}
