<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 16:52
 */

namespace MeetingRoom\Model;


class PClist
{
    private $list = array(
        'title' => 'Hello Kitty!',
        'listItem' => array(
            0 => 'First title',
            1 => 'Second title',
            2 => 'Bla-bla title',
            'test' => 'Test title'
        )
    );

    public function get(){
        return $this->list;
    }
}