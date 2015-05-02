#!/bin/bash
echo "Setting up test environment"
echo cp -v .env.travis .env

echo "Generating flysystem config file"
config="<?php return [
    'connections' => [
        'unittest' => [
            'driver' => 'local',
            'path'   => storage_path('temp'),
        ],
    ],
    'default'     => getenv('FILESYSTEM_DRIVER'),
];"
echo "$config" > config/flysystem.php
