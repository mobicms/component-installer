<?php

declare(strict_types=1);

namespace MobicmsTest\ComponentInstaller\InstallHandlers;

use Composer\Installer\LibraryInstaller;
use Mobicms\ComponentInstaller\InstallHandlers\PackagesConfigHandler;
use Mockery;
use PHPUnit\Framework\TestCase;

class ComponentConfigHandlerTest extends TestCase
{
    public function testGetSourceFileName()
    {
        $handler = new PackagesConfigHandler(Mockery::mock(LibraryInstaller::class));
        $this->assertStringEndsWith('resources/install/package.php', $handler->getSourceFileName());
    }

    public function testGetDestinationPath()
    {
        $handler = new PackagesConfigHandler(Mockery::mock(LibraryInstaller::class));
        $this->assertStringEndsWith('packages/', $handler->getDestinationPath());
    }
}
