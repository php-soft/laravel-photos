<?php

namespace PhpSoft\Photos\Providers;

class PhotoManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Drivers
     *
     * @var array
     */
    protected $drivers = [];

    /**
     * Create a new database manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['phpsoft.photos.default'];
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getUploadConfigs()
    {
        return $this->app['config']['phpsoft.photos.upload'];
    }

    /**
     * Get driver
     *
     * @param  string $name
     * @return Driver
     */
    public function driver($name = null)
    {
        if (empty($name)) {
            $name = $this->getDefaultDriver();
        }

        if (!isset($this->drivers[$name])) {
            $driverClass = $this->parseDriverName($name);
            $this->drivers[$name] = new $driverClass;
        }

        return $this->drivers[$name];
    }

    /**
     * Parse driver name
     *
     * @param  string $name
     * @return string
     */
    public function parseDriverName($name)
    {
        return '\\PhpSoft\\Photos\\Providers\\Drivers\\' . ucfirst($name) . 'Driver';
    }

    /**
     * Validate mime type
     *
     * @param  string $mimeType
     * @return boolean
     */
    public function validateMimeType($mimeType)
    {
        $uploadConfigs = $this->getUploadConfigs();

        if (!in_array($mimeType, $uploadConfigs['allow_types'])) {
            return false;
        }

        return true;
    }

    /**
     * Validate file size
     *
     * @param  integer $size
     * @return boolean
     */
    public function validateFileSize($size)
    {
        $uploadConfigs = $this->getUploadConfigs();

        if ($size > $uploadConfigs['max_file_size']) {
            return false;
        }

        return true;
    }

    /**
     * Dynamically pass methods to the default driver.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->driver(), $method], $parameters);
    }
}
