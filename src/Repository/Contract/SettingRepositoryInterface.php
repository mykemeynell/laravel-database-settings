<?php

namespace LaravelDatabaseSettings\Repository\Contract;

use ArchLayer\Repository\RepositoryInterface;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;

/**
 * Interface SettingRepositoryInterface.
 *
 * @package LaravelDatabaseSettings\Repository\Contract
 */
interface SettingRepositoryInterface extends RepositoryInterface
{
    /**
     * Find a setting entity using the key. Alias of SettingRepositoryInterface::findUsingKey(string $key).
     *
     * @param string $key
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Model|null
     * @see \LaravelDatabaseSettings\Repository\Contract\SettingRepositoryInterface::findUsingKey(string $key)
     */
    public function find(string $key): ?SettingEntityInterface;

    /**
     * Find a setting entity using its key. Returns null if no matching entity is found.
     *
     * @param string $key
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function findUsingKey(string $key): ?SettingEntityInterface;
}
