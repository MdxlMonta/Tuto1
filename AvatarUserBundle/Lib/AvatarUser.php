<?php

namespace Tuto\AvatarUserBundle\Lib;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Cours MDXL - AvatarUser - 
 * Class que devra étendre votre entity user
 * 
 * @link http://www.mdxl.xyz 
 * @author Luigi Monta <monta@mdxl.xyz>
 *
 * @category entity
 * 
 * @ORM\Table()
 * @ORM\Entity
 */
class AvatarUser
{

    /**
     * @var UploadedFile
     * 
     * @Assert\Image
     */
    protected $file;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @var string
     *
     * @ORM\Column(name="avatarToken", type="string", length=255, nullable=true)
     */
    protected $avatarToken;


    /**
     * Set file
     *
     * @param UploadedFile $file
     * @return AvatarUser
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return UploadedFile 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return AvatarUser
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set avatarToken
     *
     * @param string $avatarToken
     * @return AvatarUser
     */
    public function setAvatarToken($avatarToken)
    {
        $this->avatarToken = $avatarToken;

        return $this;
    }

    /**
     * Get avatarToken
     *
     * @return string 
     */
    public function getAvatarToken()
    {
        return $this->avatarToken;
    }
}
