<?php

namespace Tuto\AvatarUserBundle\Lib;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tuto\AvatarUserBundle\Lib\UploadInterface;

/**
 * Cours MDXL - AvatarUserBundle - 
 * Service permettant l'upload de fichier image
 * 
 * @link http://www.mdxl.xyz 
 * @author Luigi Monta <monta@mdxl.xyz>
 * 
 * @category service
 */
class Upload implements UploadInterface{
    
    /**
     * @var string
     */    
    private $path;
    
    /**
     * @var string
     */
    private $uploadDir;
    
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @param string $uploadDir le nom du dossier dans /web ou seront stocké les images
     */  
    public function __construct($uploadDir) {
        $this->uploadDir = $uploadDir;
    }
    
     /**
     * {@inheritdoc}
     */
    public function getPath() {
        return $this->path;
    }
    
    /**
     * @return Upload
     */ 
    private function setPath(){
        $name = date("y_m_d")."_".time()."_".uniqid();
        $this->path = $name.'.'.$this->file->guessExtension();
        return $this;
    }
    
     /**
     * {@inheritdoc}
     */   
    public function initFile(UploadedFile $file, $path = null) {
        $this->file = $file; 
        if  ($path === null){
            $this->setPath();
        }else{
            $this->path = $path;
        }
        return $this;          
    }

     /**
     * {@inheritdoc}
     */
    public function removePath($path) {
        if ($path !== null) {
            $f = $this->getUploadRootDir(). "/" . $path;
            if (file_exists($f)){
                unlink($f);
            }
        }
        return $this;           
    }

     /**
     * {@inheritdoc}
     */
    public function save() {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);
    	}
        return $this;           
    }
    
    /**
     * @return string
     */     
    private function getUploadRootDir() {
        return __DIR__.'/../../../../web/'.$this->uploadDir;
    }
}
