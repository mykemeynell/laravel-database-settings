<?php

namespace LaravelDatabaseSettings\Provider;

use Illuminate\Support\ServiceProvider;
use LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface;
use LaravelDatabaseSettings\Entity\SettingEntity;
use LaravelDatabaseSettings\Repository\Contract\SettingRepositoryInterface;
use LaravelDatabaseSettings\Repository\SettingRepository;
use LaravelDatabaseSettings\Service\Contract\SettingServiceInterface;
use LaravelDatabaseSettings\Service\SettingService;
use mykemeynell\Support\Providers\Concern\AliasService;
use mykemeynell\Support\Providers\Concern\ProvidesService;

/**
 * Class LaravelDatabaseSettingsProvider.
 *
 * @property \Illuminate\Foundation\Application $app
 *
 * @package LaravelDatabaseSettings\Provider
 */
class LaravelDatabaseSettingsProvider extends ServiceProvider
{
    use AliasService, ProvidesService;

    /**
     * Services that are to be aliased into application.
     *
     * @var array
     */
    protected $aliases = [
        'ldbs.entity' => [SettingEntityInterface::class],
        'ldbs.repository' => [SettingRepositoryInterface::class],
        'ldbs.service' => [SettingServiceInterface::class],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $root = realpath(__DIR__ . '/../../');

        // Inform the application of our package migrations, this is a reusable package
        // therefore the registration of these migrations are not optional for this package.
        $this->loadMigrationsFrom("{$root}/database/migrations");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerAliases();
    }

    /**
     * Register the package entities.
     *
     * @return void
     */
    protected function registerEntities(): void
    {
        $this->app->bind('ldbs.entity', SettingEntity::class);
    }

    /**
     * Register the package repositories.
     *
     * @return void
     */
    protected function registerRepositories(): void
    {
        $this->app->singleton('ldbs.repository', SettingRepository::class);
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function registerServices(): void
    {
        $this->app->singleton('ldbs.service', SettingService::class);
    }
}
