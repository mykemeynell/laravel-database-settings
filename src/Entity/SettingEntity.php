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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'application_settings';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value'
    ];

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

    /**
     * Get the name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
