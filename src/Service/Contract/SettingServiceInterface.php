<?php

namespace LaravelDatabaseSettings\Service\Contract;

use ArchLayer\Service\Contract\ServiceInterface;
use Illuminate\Support\Collection;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface SettingServiceInterface.
 *
 * @package LaravelDatabaseSettings\Service\Contract
 */
interface SettingServiceInterface extends ServiceInterface
{
    /**
     * Create a new setting entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|null
     */
    public function create(ParameterBag $payload): ?SettingEntityInterface;

    /**
     * Update an existing setting entity and save changes to the database. Changes will be cached immediately after
     * updating the database.
     *
     * @param \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                  $payload
     *
     * @return bool
     */
    public function update(SettingEntityInterface $entity, ParameterBag $payload): bool;

    /**
     * Delete an existing database entity. Changes will be cached after the setting has been removed from the database.
     *
     * @param \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface $entity
     *
     * @return mixed
     */
    public function delete(SettingEntityInterface $entity);

    /**
     * Fetch all settings from database.
     *
     * @param bool $fresh If set to true, ignore what is currently cached and fetch again.
     *
     * @return mixed
     */
    public function fetch($fresh = false);

    /**
     * Get a key value from the application settings.
     *
     * @param string $key
     * @param null   $default
     *
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function get(string $key, $default = null);

    /**
     * Flush and reload the cache.
     *
     * @return Collection
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function flush(): Collection;
}
