<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.14
 * Time: 14:33
 */

namespace MeetingRoom\Controller\Plugins;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class MyFirstPlugin extends AbstractPlugin
{
    public function getList(){
        return array(
            'id' => 1,
            'title' => 'Test plugin'
        );
    }
} 