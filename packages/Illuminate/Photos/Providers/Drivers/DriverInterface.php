<?php

namespace PhpSoft\Illuminate\Photos\Providers\Drivers;

interface DriverInterface
{
    /**
     * Upload method
     *
     * @param  string $filename
     * @param  string $publicId
     * @param  array  $options
     */
    public function upload($filename, $publicId = null, $options = []);

    /**
     * Rename method
     *
     * @param  string $oldName
     * @param  string $newName
     * @return boolean
     */
    public function rename($oldName, $newName);

    /**
     * Delete method
     *
     * @param  string $fileId
     * @return boolean
     */
    public function delete($fileId);
}
