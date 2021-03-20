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
