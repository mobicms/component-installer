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

use RecursiveDirectoryIterator as DirIterator;
use RecursiveIteratorIterator as Iterator;

/**
 * Trait FilesystemTrait
 *
 * @package mobicms/component-installer
 * @author  Oleg Kasyanov <dev@mobicms.net>
 */
trait FilesystemTrait
{
    /**
     * @param string $source
     * @param string $destination
     * @throws \RuntimeException
     */
    protected function copyRecursive($source, $destination) : void
    {
        /** @var DirIterator $iterator */
        $iterator = new Iterator(new DirIterator($source, DirIterator::SKIP_DOTS), Iterator::SELF_FIRST);
        $this->createDirectory($destination, 0755, true);

        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $this->createDirectory($destination . DIRECTORY_SEPARATOR . $iterator->getSubPathname());
            } else {
                copy(
                    (string) $item,
                    (string) $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathname()
                );
            }
        }
    }

    /**
     * @param string $path
     */
    protected function deleteRecursive($path) : void
    {
        if (is_dir($path)) {
            $this->recursiveActions($path);
            rmdir($path);
        } elseif (is_file($path)) {
            unlink($path);
        }
    }

    /**
     * @param      $pathname
     * @param int  $mode
     * @param bool $recursive
     * @throws \RuntimeException
     */
    protected function createDirectory($pathname, $mode = 0777, $recursive = false) : void
    {
        if (! mkdir($pathname, $mode, $recursive) && ! is_dir($pathname)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $pathname));
        }
    }

    /**
     * @param string $path
     */
    private function recursiveActions($path) : void
    {
        $iterator = new Iterator(new DirIterator($path, DirIterator::SKIP_DOTS), Iterator::CHILD_FIRST);

        foreach ($iterator as $item) {
            $action = ($item->isDir() ? 'rmdir' : 'unlink');
            $action($item->getRealPath());
        }
    }
}
