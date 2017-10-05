<?php

namespace Acme\Infrastructure\Repository\Doctrine;

use Acme\Domain\Contract\Repository;
use Acme\Domain\Entity\Project;
use Doctrine\Common\Persistence\ObjectRepository;
use Illuminate\Support\Collection;

/**
 * Class ARepository
 *
 * @package Acme\Infrastructure\Repository\Doctrine
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/07
 */
abstract class ARepository implements Repository
{
    /**
     * @var \Illuminate\Support\Collection
     */
    private $collection;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $criteria;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var bool
     */
    private $skipCriteria = false;

    /**
     * ARepository constructor.
     *
     * @param \Doctrine\Common\Persistence\ObjectRepository $repository
     * @param \Illuminate\Support\Collection $collection
     */
    public function __construct(ObjectRepository $repository, Collection $collection)
    {
        $this->repository = $repository;
        $this->collection = $collection;

        $this->boot();
    }

    /**
     * Subclass may override.
     *
     * @return void
     */
    public function boot() : void
    {
    }

    /**
     * @param int $id
     *
     * @return \Acme\Domain\Entity\Project|null
     */
    public function find($id) : ?Project
    {
        return $this->repository()->find($id);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function findAll() : Collection
    {
        return new Collection($this->repository()->findAll());
    }

    /**
     * @return mixed
     */
    public function makeModel() : Project
    {
        return new $this->repository->getClassName();
    }

    /**
     * @param string $column
     * @param mixed null $key
     *
     * @return \Illuminate\Support\Collection
     */
    public function pluck(string $column, $key = null) : Collection
    {
        return new Collection();
    }

    /**
     * @param $criteria
     *
     * @return \Acme\Domain\Contract\Repository
     */
    public function pushCriteria($criteria) : Repository
    {
        $this->criteria->push($criteria);

        return $this;
    }

    /**
     * @param $criteria
     *
     * @return \Acme\Domain\Contract\Repository
     */
    public function popCriteria($criteria) : Repository
    {
        $this->criteria = $this->criteria->reject(function ($item) use ($criteria) {
            if (is_object($item) && is_string($criteria)) {
                return get_class($item) === $criteria;
            }

            if (is_string($item) && is_object($criteria)) {
                return $item === get_class($criteria);
            }

            return get_class($item) === get_class($criteria);
        });

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCriteria() : Collection
    {
        return $this->criteria;
    }

    /**
     * @param bool $skip
     *
     * @return \Acme\Domain\Contract\Repository
     */
    public function skipCriteria($skip = true) : Repository
    {
        $this->skipCriteria = $skip;

        return $this;
    }

    /**
     * @return \Acme\Domain\Contract\Repository
     */
    protected function applyCriteria() : Repository
    {
        if (true === $this->skipCriteria) {
            return $this;
        }
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function repository() : ObjectRepository
    {
        return $this->repository;
    }
}
