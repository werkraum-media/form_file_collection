<?php

return [
    'sys_file' => [
        [
            'uid' => 1,
            'pid' => 0,
            'missing' => 0,
            'storage' => 1,
            'type' => 2,
            'metadata' => 0,
            'identifier' => '/Files/FirstResult.png',
            'identifier_hash' => '29b827d0daa29658d8a0d952dfd20f559bbe3bcf',
            'folder_hash' => '86d12d536195df2100a5ec04ab80c08f9bed3d31',
            'extension' => 'png',
            'mime_type' => 'image/png',
            'name' => 'FirstResult.png',
            'sha1' => 'b13f2bbf275d592534eab659c1430c2702ce31fc',
            'size' => '42383',
        ],
    ],
    'sys_file_collection' => [
        [
            'uid' => 1,
            'pid' => 1,
            'title' => 'Example for Form',
            'files' => 1,
        ],
    ],
    'sys_file_reference' => [
        [
            'uid' => 1,
            'pid' => 1,
            'uid_local' => 1,
            'uid_foreign' => 1,
            'tablenames' => 'sys_file_collection',
            'fieldname' => 'files',
            'sorting_foreign' => 2,
        ],
    ],
];
