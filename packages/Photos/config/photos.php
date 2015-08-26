<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Photo Driver Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the photo drivers below you wish
    | to use as your default driver for all photos work. Of course
    | you may use many drivers at once using the Photo library.
    |
    */

    'default' => env('PHOTOS_DRIVER', 'cloudinary'),

    /*
    |--------------------------------------------------------------------------
    | Photo Drivers
    |--------------------------------------------------------------------------
    |
    | Here are each of the photos drivers setup for your application.
    | Of course, examples of configuring each photo platform that is
    | supported by Laravel is shown below to make development simple.
    |
    */

    'drivers' => [

        'localfile' => [
            // coming soon
        ],

        'cloudinary' => [
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Upload configurations
    |--------------------------------------------------------------------------    |
    */

    'upload' => [
        'allow_types' => [
            'image/jpeg',
            'image/png',
            'image/gif',
        ],
        'max_file_size' => 2 * 1024 * 1024, // bytes
    ],

];
