<?php

namespace LaravelDatabaseSettings\Repository;

use ArchLayer\Repository\Repository;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;
use LaravelDatabaseSettings\Repository\Contract\SettingRepositoryInterface;

/**
 * Class SettingRepository.
 *
 * @package LaravelDatabaseSettings\Repository
 */
class SettingRepository extends Repository implements SettingRepositoryInterface
{
    /**
     * SettingRepository constructor.
     *
     * @param \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Model $entity
     */
    function __construct(SettingEntityInterface $entity)
    {
        $this->setModel($entity);
    }

    /**
     * Find a setting entity using the key. Alias of SettingRepositoryInterface::findUsingKey(string $key).
     *
     * @param string $key
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Modelnull
     * @see \LaravelDatabaseSettings\Repository\Contract\SettingRepositoryInterface::findUsingKey(string $key)
     */
    public function find(string $key): ?SettingEntityInterface
    {
        return $this->findUsingKey($key);
    }

    /**
     * Find a setting entity using its key. Returns null if no matching entity is found.
     *
     * @param string $key
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function findUsingKey(string $key): ?SettingEntityInterface
    {
        return $this->findUsingId($key);
    }
}
