<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'fileSavePath' => dirname(dirname(__DIR__)).'/upload/',
    'uploadSaveDirs' => array('avatar', 'banner', 'posts'),
    'imgUrl' => 'http://img.gongying.debugphp.com/',    
    'logRootPath' => dirname(dirname(__DIR__)).'/log/',
    'wx' => [
        'appId' => 'wx1bfc812312887fd2',
        'appSecret' => 'eccb65fc93ef74d2109a005ddceaab48'
    ],
    'sms' => [
        'appid' => 1400087307,
        'appkey' => '3bfe70fe99fac13040ff193559e89ac5',
        'template' => [
            'common' => [
                'templateId' => 114385,
                'expiry' => 30
            ]            
        ]
    ]
];
