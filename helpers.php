<?php

use Exfriend\SlackNotificationBuilder\SlackNotificationBuilder;

function slack( $to = null )
{
    $builder = new SlackNotificationBuilder();

    if ( $to )
    {
        $builder->to( $to );
    }

    return $builder;
}