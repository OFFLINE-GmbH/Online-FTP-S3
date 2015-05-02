#!/bin/bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

echo "Execution dir is ${DIR}"

echo "Setting up test environment"
echo cp -v ${DIR}/.env.travis ${DIR}/.env

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
echo "$config" > ${DIR}/config/flysystem.php
