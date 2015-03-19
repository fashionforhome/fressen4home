<?php

/**
 * Class ConfigsController
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