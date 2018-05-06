<?php
use DMS\Service\Meetup\MeetupKeyAuthClient;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

if(file_exists('.env')) {
    $dotenv = new Dotenv(__DIR__);
    $dotenv->load();
}

$client = MeetupKeyAuthClient::factory(array('key' => getenv('MEETUP_API_KEY')));

$command = $client->getCommand('GetGroupEventsAttendance', [
    'id' => '250485750',
    'urlname' => 'PHP-Rio'
]);
$command->prepare();
$response = $command->execute();
// print_r($response);
// $dbopts = parse_url(getenv('DATABASE_URL'));
// $database=ltrim($dbopts['path'],'/');
// $dsn = "mysql:dbname=$database;host={$dbopts['host']}";
// $pdo=new PDO($dsn, $dbopts['user'],$dbopts['pass']);
// $result=$pdo->query('desc user');
// foreach($result as $row){
//     print_r($row);
// }

foreach ($response->getData() as $user) {
    $query ="INSERT into user (id,nome) values ({$user['member']['id']}, '{$user['member']['name']}')\n";
    print_r($query);
}