<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.08.14
 * Time: 12:25
 */

namespace MeetingRoom\Entity;

use Doctrine\ORM\Mapping as ORM;
use MeetingRoom\Entity\PC as PC;

/**
 * MeetingRoom
 * @ORM\Table(name="meeting_room")
 * @ORM\Entity
 */
class MeetingRoom {
    /**
     * @var integer
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
     * @var string
     *
     * @ORM\Column(name="place", type="text", nullable=false)
     */
    private $place;
    /**
     * @var integer
     *
     * @ORM\Column(name="capacity", type="integer", nullable=true)
     */
    private $capacity;

    /**
     *
     * @var \MeetingRoom\Entity\PC
     *
     * @ORM\OneToOne(targetEntity="MeetingRoom\Entity\PC")
     * #ORM\JoinColumns({
     * @ORM\JoinColumn(name="pc_id", referencedColumnName="id")
     * })
     */
    private $pc;


    /**
     * @param $pc
     */
    public function setPc($pc) {
        $this->pc = $pc;
    }

    /**
     * @return PC
     */
    public function getPc() {
        return $this->pc;
    }

    /**
     * @return integer
     */
    public function getId(){
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
    public function setTitle($title){
        $this->title = $title;
    }
    /**
     * @return string
     */
    public function getPlace(){
        return $this->place;
    }
    /**
     * @param $place
     */
    public function setPlace($place){
        $this->place = $place;
    }
    /**
     * @return integer
     */
    public function getCapacity(){
        return $this->capacity;
    }
    /**
     * @param $capacity
     */
    public function setCapacity($capacity){
        $this->capacity = $capacity;
    }

}