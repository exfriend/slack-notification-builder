<?php

namespace Exfriend\SlackNotificationBuilder;


use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification as IlluminateNotification;
use Illuminate\Support\Facades\Notification;

class SlackNotificationBuilder
{

    public $_from;
    public $_to;
    public $_image;
    public $_content;
    public $_attachment = null;

    public function __construct()
    {
        $this->_from = config( 'slack-notification-builder.defaults.from' );
        $this->_to = config( 'slack-notification-builder.defaults.channel' );
        $this->_image = config( 'slack-notification-builder.defaults.image' );
    }

    /**
     * @param string $from
     *
     * @return SlackNotificationBuilder
     */
    public function from( string $from ) : SlackNotificationBuilder
    {
        $this->_from = $from;

        return $this;
    }

    /**
     * @param string $to
     *
     * @return SlackNotificationBuilder
     */
    public function to( string $to ) : SlackNotificationBuilder
    {
        $this->_to = $to;

        return $this;
    }

    /**
     * @param string $image
     *
     * @return SlackNotificationBuilder
     */
    public function image( string $image ) : SlackNotificationBuilder
    {
        $this->_image = $image;

        return $this;
    }

    /**
     * @param null $attachment
     *
     * @return SlackNotificationBuilder
     */
    public function attachment( $attachment )
    {
        $this->_attachment = $attachment;

        return $this;
    }

    public function send( $content = null )
    {
        if ( $content )
        {
            $this->content( $content );
        }

        Notification::route( 'slack', config( 'slack-notification-builder.webhook_url' ) )->notify(
            new class( $this ) extends IlluminateNotification
            {
                public $builder;

                public function __construct( SlackNotificationBuilder $builder )
                {
                    $this->builder = $builder;
                }

                public function via()
                {
                    return [ 'slack' ];
                }

                public function toSlack()
                {
                    $message = new SlackMessage();

                    $message = $message->from( $this->builder->_from )
                                       ->to( $this->builder->_to )
                                       ->content( $this->builder->_content );

                    if ( $this->builder->_image )
                    {
                        $message = $message->image( $this->builder->_image );
                    }

                    if ( $this->builder->_attachment )
                    {
                        $message = $message->attachment( $this->builder->_attachment );
                    }

                    return $message;
                }

            }
        );
    }

    /**
     * @param mixed $content
     *
     * @return SlackNotificationBuilder
     */
    public function content( $content )
    {
        $this->_content = $content;

        return $this;
    }

}