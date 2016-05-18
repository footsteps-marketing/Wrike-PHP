<?php

require __DIR__ . '/vendor/autoload.php';

use FSM\Wrike;

const CLIENT_ID     = 'abcdefgh';
const CLIENT_SECRET = 'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijkl';
const REDIRECT_URI  = 'http://localhost';

$wrike = new Wrike\Wrike(
    new Wrike\WrikeProvider([
        'clientId'      => CLIENT_ID,
        'clientSecret'  => CLIENT_SECRET,
        'redirectUri'   => REDIRECT_URI,
    ])
);

var_dump($wrike->Version()->get());
