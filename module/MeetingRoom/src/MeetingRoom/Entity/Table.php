<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 18.09.14
 * Time: 13:52
 */

namespace MeetingRoom\Entity;

use Doctrine\ORM\Mapping as ORM;
use MeetingRoom\Entity\User as User;
use MeetingRoom\Entity\MeetingRoom as MeetingRoom;


/**
 * MeetingRoom
 *
 * @ORM\Table(name="table")
 * @ORM\Entity
 */
class Table {

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
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var DateTime
     * @ORM\Column(name="time", type="datetime", unique=true)
     */
    private $time;

    /**
     *
     * @var \MeetingRoom\Entity\MeetingRoom
     *
     * @ORM\OneToOne(targetEntity="MeetingRoom\Entity\MeetingRoom")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meeting_room_id", referencedColumnName="id")
     * })
     */
    private $meeting_room;

    /**
     *
     * @var \MeetingRoom\Entity\User
     *
     * @ORM\OneToOne(targetEntity="MeetingRoom\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="description",type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status",type="string")
     */
    private $status;
    //////////////////////////////////////////////////////////////////////

    /**
     *
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
     *
     * @return string
     */
    public function getType(){
        return $this->type;
    }
    /**
     * @param $type
     */
    public function setType($type){
        $this->type=$type;
    }

    /**
     *
     * @return DateTime
     */
    public function getTime(){
        return $this->time;
    }
    /**
     * @param $time
     */
    public function setTime($time){
        $this->time=$time;
    }
    /**
     *
     * @return string
     */
    public function getUser(){
        return $this->user;
    }
    /**
     * @param $user
     */
    public function setUser($user){
        $this->user=$user;
    }
    /**
     *
     * @return string
     */
    public function getMeetingRoom(){
        return $this->meeting_room;
    }
    /**
     * @param MeetingRoom $meeting_room
     */
    public function setMeetingRoom($meeting_room){
        $this->meeting_room=$meeting_room;
    }
    /**
     *
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }
    /**
     * @param $description
     */
    public function setDescription($description){
        $this->description=$description;
    }

    /**
     *
     * @return string
     */
    public function getStatus(){
        return $this->status;
    }
    /**
     * @param $meeting_room
     */
    public function setStatus($status){
        $this->status=$status;
    }
}
