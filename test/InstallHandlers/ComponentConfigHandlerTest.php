<?php
/**
 * Created by PhpStorm.
 * User: Oleg Kasyanov
 * Date: 02.03.2019
 * Time: 14:21
 */

namespace MobicmsTest\System\InstallHandlers;

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
