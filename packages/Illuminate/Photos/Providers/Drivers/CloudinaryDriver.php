<?php

namespace PhpSoft\Illuminate\Photos\Providers\Drivers;

use JD\Cloudder\Facades\Cloudder;

class CloudinaryDriver implements DriverInterface
{
    /**
     * Upload method
     *
     * @param  string $filename
     * @param  string $publicId
     * @param  array  $options
     */
    public function upload($filename, $publicId = null, $options = [])
    {
        $result = Cloudder::upload($filename, $publicId, $options);

        $result = Cloudder::getResult();

        return [
            'type'  => 'cloudinary',
            'url'   => $result['url'],
            'extra' => $result,
        ];
    }

    /**
     * Rename method
     *
     * @param  string $publicId
     * @param  string $toPublicId
     * @return boolean
     */
    public function rename($publicId, $toPublicId)
    {
        return Cloudder::rename($publicId, $toPublicId);
    }

    /**
     * Delete method
     *
     * @param  string $publicId
     * @return boolean
     */
    public function delete($publicId)
    {
        return Cloudder::delete($publicId);
    }
}
