<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.14
 * Time: 14:51
 */

namespace Application\Mapper;


abstract class AbstractGrid
{
    protected $paginator;

    abstract public function getList();

    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    public function getPuginator()
    {
        return $this->paginator;
    }
}
