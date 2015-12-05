<?php

namespace Tuto\AvatarUserBundle\Lib;

use Tuto\AvatarUserBundle\Lib\UploadInterface;
use Tuto\AvatarUserBundle\Lib\AvatarUser;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;


/**
 * Cours MDXL - AvatarUserBundle - 
 * Un entityListener de AvatarUser
 * 
 * @link http://www.mdxl.xyz 
 * @author Luigi Monta <monta@mdxl.xyz>
 * 
 * @category service
 */
class AvatarUserListener {

    /**
     * @var UploadInterface
     */
    private $s_upload;

    /**
     * @var string
     */
    private $oldPath;
    
    /**
     * @param UploadInterface $s_upload le service upload (doit donc implémenté UploadInterface)
     */  
    public function __construct(UploadInterface $s_upload){
        $this->s_upload = $s_upload;

    }      
    
    /**
     * @param AvatarUser $user
     *
     * @return bool
     */      
    private function isOkFile(AvatarUser $user){
       return $user->getFile() !== null ;
    }
    
    /**
     * @param AvatarUser $user
     * @param LifecycleEventArgs $args
     *
     */     
    public function prePersist(AvatarUser $user, LifecycleEventArgs $args){
        $this->isOkFile($user) ? $user->setPath($this->s_upload->initFile($user->getFile())->getPath()) : null  ;
    }
    
    /**
     * @param AvatarUser $user
     * @param LifecycleEventArgs $args
     *
     */      
    public function postPersist(AvatarUser $user, LifecycleEventArgs $args){
        $this->isOkFile($user) ? $this->s_upload->save() : null;
    }
    
    /**
     * @param AvatarUser $user
     * @param PreUpdateEventArgs  $args
     *
     */      
    public function preUpdate(AvatarUser $user, PreUpdateEventArgs  $args){
        if ($this->isOkFile($user)){               
            $this->oldPath = $user->getPath();
            $user->setPath($this->s_upload->initFile($user->getFile())->getPath());
        }   
    }
    
    /**
     * @param AvatarUser $user
     * @param LifecycleEventArgs $args
     *
     */   
    public function postUpdate(AvatarUser $user, LifecycleEventArgs $args){
        $this->isOkFile($user) ? $this->s_upload->save()->removePath($this->oldPath) : null;
    }
    
    /**
     * @param AvatarUser $user
     * @param LifecycleEventArgs $args
     *
     */       
    public function postLoad(AvatarUser $user, LifecycleEventArgs $args){   
       $user->setAvatarToken(sha1(uniqid(mt_rand(), true)));

    }
    
    /**
     * @param AvatarUser $user
     * @param LifecycleEventArgs $args
     *
     */      
    public function postRemove(AvatarUser $user, LifecycleEventArgs $args) {
        $this->s_upload->removePath($user->getPath());
    }


}