<?php

namespace Tuto\AvatarUserBundle\Lib;

use Tuto\AvatarUserBundle\Lib\UploadInterface;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

/**
 * Cours MDXL - AvatarUserBundle - 
 * Un subscriber tagé par doctrine.event_subscriber
 * 
 * @link http://www.mdxl.xyz 
 * @author Luigi Monta <monta@mdxl.xyz>
 * 
 * @category service
 */
class AvatarSubscriber implements EventSubscriber{

    /**
     * @var UploadInterface
     */
    private $s_upload;

    /**
     * @var string
     */
    private $oldPath;
    
    /**
     * @var string
     */
    private $className;

    /**
     * @param UploadInterface $s_upload le service upload (doit donc implémenté UploadInterface)
     * @param string $className Le nom de la class de l'entity a surveillé
     */  
    public function __construct(UploadInterface $s_upload, $className){
        $this->s_upload = $s_upload;
        $this->className = $className;
    }
    
    /**
     * @param object $entity une entity mappé par doctrine
     *
     * @return bool
     */      
    private function isOk($entity){
       return $entity instanceof  $this->className ;
    }  
    
    /**
     * @param object $entity une entity mappé par doctrine
     *
     * @return bool
     */      
    private function isOkFile($entity){
       return $this->isOk($entity) && $entity->getFile() !== null ;
    }
    
    /**
     * @param LifecycleEventArgs $args
     *
     */     
    public function prePersist(LifecycleEventArgs $args){
        $this->isOkFile($entity= $args->getEntity()) ? $entity->setPath($this->s_upload->initFile($entity->getFile())->getPath()) : null  ;
    }
    
    /**
     * @param LifecycleEventArgs $args
     *
     */      
    public function postPersist(LifecycleEventArgs $args){
        $this->isOkFile($args->getEntity()) ? $this->s_upload->save() : null;
    }
    
    /**
     * @param LifecycleEventArgs $args
     *
     */      
    public function preUpdate(LifecycleEventArgs $args){
        if ($this->isOkFile($entity= $args->getEntity())){               
            $this->oldPath = $entity->getPath();
            $entity->setPath($this->s_upload->initFile($entity->getFile())->getPath());
        }   
    }
    
    /**
     * @param LifecycleEventArgs $args
     *
     */      
    public function postUpdate(LifecycleEventArgs $args){
        $this->isOkFile($args->getEntity()) ? $this->s_upload->save()->removePath($this->oldPath) : null;
    }
    
    /**
     * @param LifecycleEventArgs $args
     *
     */      
    public function postLoad(LifecycleEventArgs $args){   
        $this->isOk($entity= $args->getEntity()) ? $entity->setAvatarToken(sha1(uniqid(mt_rand(), true))) : null;
    }
    
    /**
     * @param LifecycleEventArgs $args
     *
     */      
    public function postRemove(LifecycleEventArgs $args) {
        $this->isOk($entity= $args->getEntity()) ? $this->s_upload->removePath($entity->getPath()) : null;
    }

     /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents() {
       return array(
           'prePersist',
           'postPersist',
           'preUpdate',
           'postUpdate',
           'postRemove',
           'postLoad',
       );         
    }

}