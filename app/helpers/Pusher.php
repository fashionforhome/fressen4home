<?php

namespace F4H;

class Pusher
{
    static public function push($event, $message) {
        $pusher = new \Pusher(
            \Config::get('pusher.app_key'),
            \Config::get('pusher.app_secret'),
            \Config::get('pusher.app_id')
        );

        $pusher->trigger(
            \Config::get('pusher.channel'),
            $event,
            array('message' => json_encode($message))
        );
    }
}

