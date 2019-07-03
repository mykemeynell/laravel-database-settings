<?php

namespace LaravelDatabaseSettings\Service;

use ArchLayer\Service\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;
use LaravelDatabaseSettings\Repository\Contract\SettingRepositoryInterface;
use LaravelDatabaseSettings\Service\Contract\SettingServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class SettingService.
 *
 * @package LaravelDatabaseSettings\Service
 */
class SettingService extends Service implements SettingServiceInterface
{
    /**
     * The key used to store application settings in cache.
     *
     * @var string
     */
    protected $cache_key = 'application_settings';

    /**
     * SettingService constructor.
     *
     * @param \LaravelDatabaseSettings\Repository\Contract\SettingRepositoryInterface|\ArchLayer\Repository\Repository $repository
     */
    function __construct(SettingRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    /**
     * Create a new setting entity and save it to the database.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $payload
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|null
     */
    public function create(ParameterBag $payload): ?SettingEntityInterface
    {
        /** @var \LaravelDatabaseSettings\Entity\SettingEntity $setting */
        $setting = $this->getRepository()->create(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
        $setting->save();

        return $setting;
    }

    /**
     * Update an existing setting entity and save changes to the database. Changes will be cached immediately after
     * updating the database.
     *
     * @param \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface $entity
     * @param \Symfony\Component\HttpFoundation\ParameterBag                  $payload
     *
     * @return bool
     */
    public function update(SettingEntityInterface $entity, ParameterBag $payload): bool
    {
        /** @var \LaravelDatabaseSettings\Entity\SettingEntity $entity */
        return $entity->update(
            Arr::only($payload->all(), $this->getRepository()->getModel()->getFillable())
        );
    }

    /**
     * Delete an existing database entity. Changes will be cached after the setting has been removed from the database.
     *
     * @param \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete(SettingEntityInterface $entity)
    {
        /** @var \LaravelDatabaseSettings\Entity\SettingEntity $entity */
        return $entity->delete();
    }

    /**
     * Fetch all settings from database.
     *
     * @param bool $fresh If set to true, ignore what is currently cached and fetch again.
     *
     * @return mixed
     * @throws \Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function fetch($fresh = false)
    {
        if ($fresh || ! cache()->has($this->cache_key)) {
            cache()->rememberForever($this->cache_key, function () {
                return $this->getRepository()->builder()->get();
            });
        }

        return cache()->pull($this->cache_key);
    }

    /**
     * Attempt to find a setting entity using its key.
     *
     * @param $key
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEntityUsingKey($key): ?SettingEntityInterface
    {
        return $this->getRepository()->builder()->where('key', $key)->first();
    }

    /**
     * Attempt to find a setting entity using its ID.
     *
     * @param $id
     *
     * @return \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEntityUsingId($id): ?SettingEntityInterface
    {
        return $this->getRepository()->findUsingId($id);
    }

    /**
     * Get a key value from the application settings.
     *
     * @param string $key
     * @param null   $default
     *
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function get(string $key, $default = null)
    {
        $query = $this->fetch()->where('key', $key);

        return ! $query->isEmpty()
            ? $query->first()->getValue()
            : $default;
    }

    /**
     * Set the value of a setting in the database.
     *
     * @param string $key
     * @param        $value
     *
     * @param null   $name
     * @param null   $description
     *
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function set(string $key, $value, $name = null, $description = null): bool
    {
        try {
            $setting = $this->getRepository()->builder()->firstOrNew(compact('key'));

            $attributes = compact('name');

            if(! empty($name)) {
                $attributes['name'] = $name;
            }

            if(! empty($description)) {
                $attributes['description'] = $description;
            }

            $setting->fill($attributes);
            $setting->save();

            $this->flush();

            return true;
        } catch(\Exception $exception) {
            return false;
        }
    }

    /**
     * Flush and reload the cache.
     *
     * @return Collection
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function flush(): Collection
    {
        return $this->fetch(true);
    }
}
