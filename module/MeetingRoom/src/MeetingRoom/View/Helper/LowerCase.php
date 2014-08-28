<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.08.14
 * Time: 14:03
 */

namespace MeetingRoom\View\Helper;

use Zend\View\Helper\AbstractHelper;

class LowerCase extends AbstractHelper
{
    public function __invoke($string)
    {
        return strtolower($string);
    }
} 