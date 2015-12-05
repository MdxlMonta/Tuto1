<?php

namespace Tuto\AvatarUserBundle\Lib;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Cours MDXL - AvatarUserBundle -
 * Interface utile a AvatarSubscriber pour utiliser un service d'upload d'images
 * 
 * @link http://www.mdxl.xyz 
 * @author Luigi Monta <monta@mdxl.xyz>
 * 
 */
interface UploadInterface {
    
    /**
     * @param UploadedFile $file
     * @param string|null $path
     *
     * @return UploadInterface
     */    
    public function initFile(UploadedFile $file,$path = null);

    /**
     * @return string
     */ 
    public function getPath();

    /**
     * @return UploadInterface
     */     
    public function save();
    
    /**
     * @param string $path
     * 
     * @return UploadInterface
     */     
    public function removePath($path);
    
}

