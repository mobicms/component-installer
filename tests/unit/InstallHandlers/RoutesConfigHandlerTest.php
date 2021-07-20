<?php

declare(strict_types=1);

namespace MobicmsTest\ComponentInstaller\InstallHandlers;

use Composer\Installer\LibraryInstaller;
use Mobicms\ComponentInstaller\InstallHandlers\RoutesConfigHandler;
use Mockery;
use PHPUnit\Framework\TestCase;

class RoutesConfigHandlerTest extends TestCase
{
    public function testGetSourceFileName()
    {
        $handler = new RoutesConfigHandler(Mockery::mock(LibraryInstaller::class));
        $this->assertStringEndsWith('resources/install/routes.php', $handler->getSourceFileName());
    }

    public function testGetDestinationPath()
    {
        $handler = new RoutesConfigHandler(Mockery::mock(LibraryInstaller::class));
        $this->assertStringEndsWith('routes/', $handler->getDestinationPath());
    }
}
