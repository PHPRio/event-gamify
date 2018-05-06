<?php
if(file_exists('.env')) {
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
}
$dbopts = parse_url(getenv('DATABASE_URL'));
$db = [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations'
    ],
    'environments' => [
        'default_database'=> 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => $dbopts['host'],
            'name' => ltrim($dbopts['path'],'/'),
            'user' => $dbopts['user'],
            'pass' => $dbopts['pass']
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => $dbopts['host'],
            'name' => ltrim($dbopts['path'],'/'),
            'user' => $dbopts['user'],
            'pass' => $dbopts['pass']
        ]
    ]
];
return $db;