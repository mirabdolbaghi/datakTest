<?php
/**
 * Created by PhpStorm.
 * User: mohammadmira
 * Date: 2/29/20
 * Time: 2:19 PM
 */

namespace App\Repository;

use App\UserEvent;
use App\User;
use App\Event;
use \Illuminate\Support\Facades\DB;

class EventRepository
{

    public function eventGuests($event_id)
    {
        return User::select('users.id','users.name','users.image',DB::raw('user_events.status as status'))
            ->where('user_events.event_id',$event_id)->join('user_events','users.id','=','user_events.user_id')->get();
    }
    public function createEvent(string $name, string $dateTime,int $owner_id):Event
    {
        $event = new Event();
        $event->name = $name;
        $event->due_date = $dateTime;
        $event->owner_id = $owner_id;
        $event->save();
        return $event;
    }

    public function UserEvents($user_id)
    {
        return Event::where('owner_id',$user_id)->get();
    }
}