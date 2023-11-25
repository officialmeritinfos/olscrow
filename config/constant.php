<?php

return [
    'flutterwave'=>[
        'pubKey'=>'FLWPUBK_TEST-3f3e3567873f08d08b05f7c86324b3b5-X',
        'secKey'=>'FLWSECK_TEST-8424663fe12ae847fbfa1f3d03d4e731-X',
        'encKey'=>'FLWSECK_TEST38044f71992f',
//        'pubKey'=>'FLWPUBK-3c4fc875c58e3972e22065dbed652b6a-X',
//        'secKey'=>'FLWSECK-c628ce172ec27f81cffd9c6ff142ba87-18bf3b79896vt-X',
//        'encKey'=>'c628ce172ec24f2ea360b9eb',
        'url'=>'https://api.flutterwave.com/v3/',
        'secHash'=>'meritinfos47298815Me!'
    ],
    'vpay'=>[
        'pubKey'=>'dd571119-2f6d-469b-908f-3488ffdf5254',
        'secKey'=>'ac9d962d-80eb-4cc0-8d8a-2d4317f26a87'
    ],
    'tatum'=>[
        'solutions'=>[
            'wallet'=>[
                'test'=>'',
                'live'=>''
            ],
            'infrastructure'=>[
                'test'=>'',
                'live'=>''
            ],
            'business'=>[
                'test'=>'094ac9bf-f2f8-49ba-afd5-9d9ac28ce827',
                'live'=>'ff7bc0ac-aed6-4a5b-a88a-135b2554de3c'
            ]
        ],
        'url'=>'https://api.tatum.io/v3/',
        'isLive'=>2
    ],

];
