<?php

namespace ContaoThemesNet\ConvertThemeBundle\Dca;

use Contao\CoreBundle\Framework\ContaoFramework;

class tl_content
{
    /**
     * On generate the label.
     *
     * @param array $row
     *
     * @return string
     */
    public function onGenerateLabel(array $row): string
    {
        echo "onGenerateLabel";
        var_dump($row);
    }
}