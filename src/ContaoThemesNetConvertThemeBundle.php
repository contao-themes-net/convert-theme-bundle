<?php

namespace ContaoThemesNet\ConvertThemeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoThemesNetConvertThemeBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
