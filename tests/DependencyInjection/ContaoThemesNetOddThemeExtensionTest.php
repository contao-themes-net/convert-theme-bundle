<?php

declare(strict_types=1);

/*
 * CONVERT theme for Contao Open Source CMS
 *
 * Copyright (C) 2025 pdir / digital agentur // pdir GmbH
 *
 * @package    contao-themes-net/convert-theme-bundle
 * @link       https://github.com/contao-themes-net/convert-theme-bundle
 * @license    pdir contao theme licence
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ContaoThemesNet\ConvertThemeBundle\DependencyInjection\Tests;

use ContaoThemesNet\ConvertThemeBundle\DependencyInjection\ContaoThemesNetConvertThemeExtension;
use PHPUnit\Framework\TestCase;

class ContaoThemesNetConvertThemeExtensionTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new ContaoThemesNetConvertThemeExtension();

        $this->assertInstanceOf('ContaoThemesNet\ConvertThemeBundle\DependencyInjection\ContaoThemesNetConvertThemeExtension', $bundle);
    }
}
