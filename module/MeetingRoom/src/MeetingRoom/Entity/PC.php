<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.08.14
 * Time: 14:10
 */

namespace MeetingRoom\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PC
 *
 * @ORM\Table(name="pc")
 * @ORM\Entity
 */
class PC
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="is_camera", type="boolean", nullable=false, options={"default" = 0})
     */
    private $isCamera;

    /**
     * @var int
     *
     * @ORM\Column(name="is_internet", type="boolean", nullable=false, options={"default" = 0})
     */
    private $isInternet;

    public function __construct(){
        $this->isInternet = false;
        $this->isCamera = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @return int
     */
    public function getIsCamera(){
        return $this->isCamera;
    }

    /**
     * @param $isCamera
     */
    public function setIsCamera($isCamera){
        $this->isCamera = $isCamera;
    }

    /**
     * @return int
     */
    public function getIsInternet(){
        return $this->isInternet;
    }

    /**
     * @param $isInternet
     */
    public function setIsInternet($isInternet){
        $this->isInternet = $isInternet;
    }
} 