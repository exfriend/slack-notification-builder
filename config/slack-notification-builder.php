<?php

return [
    'webhook_url' => env( 'SLACK_WEBHOOK_URL' ),

    'defaults' => [
        'channel' => '#general',
        'from'    => 'Laravel',
    ],
];