<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.14
 * Time: 12:20
 */

namespace MeetingRoom\Form;

use Zend\Permissions\Rbac\Rbac;
use Zend\Permissions\Rbac\AbstractRole;
use Zend\Form\Form;

class PcForm extends Form
{

    public function __construct()
    {
        parent::__construct('pc');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'MeetingRoom\Form\PcFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
            ),
        ));
    }


}
/*
$rbac = new Rbac();

$foo= ('foo');
$bar=('bar');

// 1 - Add a role with child role directly with instantiated classes.
$foo->addChild($bar);
$rbac->addRole($foo);

// 2 - Same as one, only via rbac container.
$rbac->addRole('boo', 'baz'); // baz is a parent of boo
$rbac->addRole('baz', array('out', 'of', 'roles')); // create several parents of baz



//var_dump($rbac->hasRole('foo'));*/

?>
