<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => 'static',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 'static',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

//        'static' => [
//            'driver'   => 'ftp',
//            'host'     => '123.30.174.147',
//            'username' => 'filemanager_vnedutech',
//            'password' => '83o5WcI30UxDuZRfUi',
//            //Các thông số mở rộng
//             'port'     => 21,
//             'root'     => 'cuocthiv2',
//             'passive'  => true,
//            // 'ssl'      => true,
//            // 'timeout'  => 30,
//        ],
        'static' => [
            'driver'   => 'ftp',
            'host'     => '123.30.174.144',
            'username' => 'stc_gthd',
            'password' => 'hiIVqHR4AZYpR9v102',
            //Các thông số mở rộng
             'port'     => 21,
             'root'     => '',
             'passive'  => true,
            // 'ssl'      => true,
            // 'timeout'  => 30,
        ],


        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
