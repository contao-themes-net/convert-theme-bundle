<?php

namespace ContaoThemesNet\ConvertThemeBundle\Module;

class ConvertThemeSetup extends \BackendModule
{
    const VERSION = '1.3.3';

    protected $strTemplate = 'be_converttheme_setup';

    /**
     * Generate the module
     */
    protected function compile()
    {
        switch (\Input::get('act')) {
            case 'syncFolder':
                $this->Template->version = ConvertThemeSetup::VERSION;
                $path = TL_ROOT . '/web/bundles/contaothemesnetconverttheme';
                if(!file_exists("files/convert")) {
                    new \Folder("files/convert");
                }
                $this->getFiles($path);
                $this->getSqlFiles($path = TL_ROOT . "/vendor/contao-themes-net/convert-theme-bundle/src/templates");
                $this->Template->message = true;
                break;
            case 'truncateTlFiles':
                $this->Template->version = ConvertThemeSetup::VERSION;
                $this->import('Database');
                $this->Database->prepare("TRUNCATE tl_files")->execute();
                $this->Template->messageTruncate = true;
                break;
            default:
                $this->Template->version = ConvertThemeSetup::VERSION;
        }
    }

    protected function getFiles($path) {
        foreach (scan($path) as $dir) {
            if(!is_dir($path."/".$dir)) {
                $pos = strpos($path,"contaothemesnetconverttheme");
                $filesFolder = "files/convert".str_replace("contaothemesnetconverttheme","",substr($path,$pos))."/".$dir;

                if($dir == "_custom_variables.scss" || $dir == "custom.scss") {
                    if(!file_exists(TL_ROOT."/".$filesFolder)) {
                        $objFile = new \File("web/bundles/".substr($path,$pos)."/".$dir, true);
                        $objFile->copyTo($filesFolder);
                    }
                } else if(strpos($filesFolder,"/img/") !== false || strpos($filesFolder,"/css/") !== false || strpos($filesFolder,".public") !== false) {
                    if(!file_exists(TL_ROOT."/".$filesFolder)) {
                        $objFile = new \File("web/bundles/".substr($path,$pos)."/".$dir, true);
                        $objFile->copyTo($filesFolder);
                    }
                }
            } else {
                $folder = $path."/".$dir;
                $pos = strpos($path,"contaothemesnetconverttheme");
                $filesFolder = "files/convert".str_replace("contaothemesnetconverttheme","",substr($path,$pos))."/".$dir;

                if($dir == "scss" || $dir == "img" || $dir == "css" || $dir == "app") {
                    if(!file_exists($filesFolder)) {
                        new \Folder($filesFolder);
                    }
                    $this->getFiles($folder);
                }
            }
        }
    }

    protected function getSqlFiles($path) {
        foreach (scan($path) as $dir) {
            if(!is_dir($path."/".$dir)) {
                $pos = strpos($path,"/vendor");
                $filesFolder = "templates/" . $dir;
                $objFile = new \File(substr($path,$pos)."/".$dir, true);
                $objFile->copyTo($filesFolder);
            }
        }
    }
}
