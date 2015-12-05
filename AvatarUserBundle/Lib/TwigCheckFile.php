<?php

namespace Tuto\AvatarUserBundle\Lib;

/**
 * Cours MDXL - AvatarUserBundle - 
 * Un service pour une extension twig
 * 
 * @link http://www.mdxl.xyz 
 * @author Luigi Monta <monta@mdxl.xyz>
 * 
 * @category service
 */
class TwigCheckFile extends \Twig_Extension {
    
    /**
     * @var string
     */
    private $uploadDir;
    
    /**
     * @var string
     */    
    private $unknowFile;
    
    public function __construct($uploadDir,$unknowFile) {
        $this->uploadDir = $uploadDir;
        $this->unknowFile = $unknowFile;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'twig_check_file';
    }
    
    /**
     * {@inheritdoc}
     */  
      public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('checkFile', array($this, 'checkFile')),
        );       
    }    

    /**
     * @param string $path
     * 
     * @return string
     */    
    public function checkFile($path) {
            if ($path != null) {
                $f = $this->getUploadRootDir(). "/" . $path;
                if (file_exists($f)){
                    return $this->uploadDir. "/". $path;
                }
            }
            return $this->unknowFile;
    }

    /**
     * @return string
     */   
    private function getUploadRootDir() {
        return __DIR__.'/../../../../web/'.$this->uploadDir;
    }

}