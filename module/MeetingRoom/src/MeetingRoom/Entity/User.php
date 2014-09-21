<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 10.09.14
 * Time: 11:57
 */

namespace MeetingRoom\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User {

    const ROLE_ADMINISTRATOR="Администратор";
    const ROLE_INITIATOR="Инициатор";
    const ROLE_OBSERVER="Наблюдатель";

/////////////////////////////////////////////////////////////////////////
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(name="login", type="string", unique=true)
     */
    private $login;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    private $password;
    /**
     * @var string
     * @ORM\Column(name="fio",type="string")
     */
    private $fio;
    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string")
     */
    private $post;
    /**
     * @var string
     * @ORM\Column(name="email",type="string")
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string")
     */
    private $role;
    /**
     * @ORM\Column(type="blob")
     */
    private $avatar;
/////////////////////////////////////////////////////
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
    public function getLogin(){
        return $this->login;
    }

    /**
     * @param $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFIO(){
        return $this->fio;
    }

    /**
     * @param $fio
     */
    public function setFIO($fio)
    {
        $this->fio = $fio;
    }

    /**
     * @return string
     */
    public function getPost(){
        return $this->post;
    }

    /**
     * @param $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getRole(){
        return $this->role;
    }

    /**
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return blob
     */
    public function getAvatar(){
        return $this->avatar;
    }

    /**
     * @param $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }



} 