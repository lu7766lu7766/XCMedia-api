<?php
return [
    'admin'                  => [
        'profile'  => [
            'account'      => 'admin',
            'display_name' => '最高權限者',
            'mail'         => 'admin@house.cc',
            'phone'        => '3939889',
            'status'       => 'enable'
        ],
        'password' => env('ADMIN_PASSWORD', 'nameis9527')
    ],
    'cover_max_size'         => 260,
    'cover_upload_base_path' => 'account/cover',
];
