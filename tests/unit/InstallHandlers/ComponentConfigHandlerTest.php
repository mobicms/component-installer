<?php

declare(strict_types=1);

/*
 * This file is part of mobiCMS Content Management System.
 *
 * @copyright   Oleg Kasyanov <dev@mobicms.net>
 * @license     https://opensource.org/licenses/GPL-3.0 GPL-3.0 (see the LICENSE.md file)
 * @link        http://mobicms.org mobiCMS Project
 */

namespace MobicmsTest\ComponentInstaller\InstallHandlers;

use Composer\Installer\LibraryInstaller;
use Mobicms\ComponentInstaller\InstallHandlers\ComponentConfigHandler;
use PHPUnit\Framework\TestCase;

class ComponentConfigHandlerTest extends TestCase
{
    public function testGetSourceFileName()
    {
        $installer = $this->prophesize(LibraryInstaller::class);
        $handler = new ComponentConfigHandler($installer->reveal());
        $this->assertStringEndsWith('config.component.php', $handler->getSourceFileName());
    }

    public function testGetDestinationPath()
    {
        $installer = $this->prophesize(LibraryInstaller::class);
        $handler = new ComponentConfigHandler($installer->reveal());
        $this->assertStringEndsWith('components/', $handler->getDestinationPath());
    }
}
