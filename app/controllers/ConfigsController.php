<?php

/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Controllers
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
class ConfigsController extends BaseController
{
    /**
     * show all configs
     *
     * @return mixed
     */
    public function getAll()
    {
        return View::make('user.configs', array(
            'configs' => array(
                'notify_created' => Auth::user()->notify_created,
                'notify_incoming' => Auth::user()->notify_incoming
            )
        ));
    }

    /**
     * save the configs
     *
     * @return mixed
     */
    public function postSave()
    {
        $user = Auth::user();
        $user->notify_created = Input::get('notify_created') ? true : false;
        $user->notify_incoming = Input::get('notify_incoming') ? true : false;
        $user->save();

        return Redirect::back();
    }
}