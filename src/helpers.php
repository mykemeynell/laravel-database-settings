<?php

if(! function_exists('settings')) {
    /**
     * Access to the settings object.
     *
     * @param null $key
     * @param null $default
     *
     * @return \LaravelDatabaseSettings\Service\Contract\SettingServiceInterface|mixed
     */
    function settings($key = null, $default = null)
    {
        /** @var \LaravelDatabaseSettings\Service\SettingService $service */
        $service = app('ldbs.service');

        if(! is_null($key)) {
            return $service->get($key, $default);
        }

        return $service;
    }
}
