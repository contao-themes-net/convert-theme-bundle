<?php

namespace ContaoThemesNet\ConvertThemeBundle\Tests;

use ContaoThemesNet\ConvertThemeBundle\ContaoThemesNetConvertThemeBundle;
use PHPUnit\Framework\TestCase;

class ContaoThemesNetConvertThemeBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoThemesNetConvertThemeBundle();

        $this->assertInstanceOf('ContaoThemesNet\ConvertThemeBundle\ContaoThemesNetConvertThemeBundle', $bundle);
    }
}
