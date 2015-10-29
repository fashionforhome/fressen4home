<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Helpers
 *
 * @author Eduard Bess <eduard.bess@fashion4home.de>
 *
 * @copyright (c) 2015 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 24.03.2015
 * Time: 22:04
 */

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

