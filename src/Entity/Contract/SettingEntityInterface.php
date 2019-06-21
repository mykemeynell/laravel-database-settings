<?php

namespace LaravelDatabaseSettings\Entity\Contract;

/**
 * Interface SettingEntityInterface.
 *
 * @property string         $key
 * @property string|null    $value
 * @property string|null    $name
 * @property string|null    $description
 *
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

    /**
     * Get the name.
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Get the description.
     *
     * @return string|null
     */
    public function getDescription(): ?string;
}
