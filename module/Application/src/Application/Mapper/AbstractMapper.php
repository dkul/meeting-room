<?php

namespace Application\Mapper;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Application\Mapper\EntityManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\ORM\Query\Expr;

class AbstractMapper implements EntityManagerAwareInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @param EntityManager $em
     * @param string $entityClassname
     * @throws \Exception
     */
    public function __construct(EntityManager $em, $entityClassname = '')
    {
        $this->setEntityManager($em);
        $this->setEntityClass($entityClassname);
        if ($this->entityClass === null) {
            throw new \Exception('Set Entity class!');
        }
    }

    public function setEntityClass($entityClassname)
    {
        $this->entityClass = $entityClassname;
        return $this;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return $this|mixed
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Flush objects to store
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    public function persist($entity, $forceUpdate = false)
    {
        if ($forceUpdate) {
            $this->getEntityManager()->merge($entity);
        } else {
            $this->getEntityManager()->persist($entity);
        }
    }

    /**
     * Сохранение объекта
     *
     * @param $entity
     * @param bool|string $forceUpdate , possible values: true, false, 'forceInsert'
     */
    public function save($entity, $forceUpdate = false)
    {
        if ($forceUpdate && ($forceUpdate !== 'forceInsert')) {
            $this->getEntityManager()->merge($entity);
        } else {
            $this->getEntityManager()->persist($entity);
        }
        $this->flush();
    }

    /**
     * Получение объекта из хранилища
     *
     * @param $id integer
     * @return object
     */
    public function getItemById($id)
    {
        return $this->getEntityManager()
            ->getRepository($this->entityClass)
            ->find($id);
    }

    /**
     * Finds entities by a set of criteria.
     *
     * @param array $criteria
     * @param array $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getEntityManager()
            ->getRepository($this->entityClass)
            ->findBy($criteria, $orderBy, $limit, $offset);
    }


    /**
     * @param array $criteria
     * @param array $orderBy
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getEntityManager()
            ->getRepository($this->entityClass)
            ->findOneBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Получение объекта гидратора
     * @return DoctrineObject
     */
    public function getHydrator()
    {
        return new DoctrineObject(
            $this->getEntityManager(), $this->entityClass, false
        );
    }

    /**
     * Заполение объекта данными из массива
     *
     * @param object $entity
     * @param array $data
     * @return object
     */
    public function mergeFromArray($entity, array $data)
    {
        return $this->getHydrator()->hydrate($data, $entity);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data = null)
    {
        $entity = new $this->entityClass;

        if ($data != null) {
            $this->getHydrator()->hydrate($data, $entity);
        }

        return $entity;
    }

    /**
     * Удаление объекта
     * @param $entity
     */
    public function remove($entity)
    {
        $this->getEntityManager()->remove($entity);
    }

}