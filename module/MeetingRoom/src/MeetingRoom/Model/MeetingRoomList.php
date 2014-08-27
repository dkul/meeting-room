<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.14
 * Time: 14:44
 */

namespace MeetingRoom\Model;


class MeetingRoomList {

    private $list = array(
        'title'=>"Hello, world!",
        'listItem' => array(
            0 => 'First title',
            1 => 'Second title',
            2 => 'Bla-bla title',
            'test' =>'test title'
        )
    );

    public function get(){
        return $this->list;
    }

} 