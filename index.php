<?php
use DMS\Service\Meetup\MeetupKeyAuthClient;

require 'vendor/autoload.php';

new MeetupKeyAuthClient(['key' => getenv('MEETUP_API_KEY')]);