<?php

namespace LaravelDatabaseSettings\Entity;

use Illuminate\Database\Eloquent\Model;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;

/**
 * Class SettingEntity.
 *
 * @package LaravelDatabaseSettings\Entity
 */
class SettingEntity extends Model implements SettingEntityInterface
{
    /**
     * Get the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        if($json = json_decode($this->value)) {
            return $json;
        }

        return $this->value;
    }
}
