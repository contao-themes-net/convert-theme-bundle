<?php

declare(strict_types=1);

/*
 * convert theme for Contao Open Source CMS
 *
 * Copyright (C) 2023 pdir / digital agentur // pdir GmbH
 *
 * @package    contao-themes-net/convert-theme-bundle
 * @link       https://github.com/contao-themes-net/convert-theme-bundle
 * @license    pdir contao theme licence
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ContaoThemesNet\ConvertThemeBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ThemeStyleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('addToThemeStyles', [$this, 'addStylesToGlobal']),
        ];
    }

    /**
     * @param array<int, string> $styles
     */
    public function addStylesToGlobal(array $styles): void
    {
        $GLOBALS['CONVERT_STYLES'] = array_merge($GLOBALS['CONVERT_STYLES'], $styles);
    }
}
