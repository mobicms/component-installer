<?php
/**
 * Created by PhpStorm.
 * User: Oleg Kasyanov
 * Date: 02.03.2019
 * Time: 13:45
 */

namespace MobicmsTest\System\InstallHandlers;

use Composer\Installer\LibraryInstaller;
use Mobicms\ComponentInstaller\InstallHandlers\RoutesConfigHandler;
use PHPUnit\Framework\TestCase;

class RoutesConfigHandlerTest extends TestCase
{
    public function testGetSourceFileName()
    {
        $installer = $this->prophesize(LibraryInstaller::class);
        $handler = new RoutesConfigHandler($installer->reveal());
        $this->assertStringEndsWith('config.routes.php', $handler->getSourceFileName());
    }

    public function testGetDestinationPath()
    {
        $installer = $this->prophesize(LibraryInstaller::class);
        $handler = new RoutesConfigHandler($installer->reveal());
        $this->assertStringEndsWith('routes/', $handler->getDestinationPath());
    }
}
