<?php

namespace LaravelDatabaseSettings\Entity\Contract;

/**
 * Interface SettingEntityInterface.
 *
 * @property string         $key
 * @property string|null    $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package LaravelDatabaseSettings\Entity\Contract
 */
interface SettingEntityInterface
{
    /**
     * Get the key.
     *
     * @return mixed
     */
    public function getKey();

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function getValue();
}
