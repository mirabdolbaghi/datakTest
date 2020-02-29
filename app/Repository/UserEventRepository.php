<?php
/**
 * Created by PhpStorm.
 * User: mohammadmira
 * Date: 2/29/20
 * Time: 2:06 PM
 */

namespace App\Repository;

use App\UserEvent;
use App\User;

class UserEventRepository
{
    public function inviteToEvent($users,$event)
    {
        foreach ($users as $user)
            $user_events[]=[
                'user_id'=> $user->id,
                'event_id'=> $event->id,
                'status'  => UserEvent::$requested_status
            ];

        return UserEvent::insert($user_events);
    }

    public function UserInvitedEvents($user_id)
    {
        $UserEvents = UserEvent::with('event')->where('user_id',$user_id )->get();

        return $UserEvents;
    }

    public function AcceptEvents($userEvent_id)
    {
        $userEvent = UserEvent::where('id',$userEvent_id)->update(['status' => UserEvent::$accepted_status]);
        return $userEvent;
    }

    public function DeclineEvents($userEvent_id)
    {
        $userEvent = UserEvent::where('id',$userEvent_id)->update(['status' => UserEvent::$declined_status]);
        return $userEvent;
    }
}