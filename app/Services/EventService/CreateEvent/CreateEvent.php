<?php
/**
 * Created by PhpStorm.
 * User: mohammadmira
 * Date: 2/29/20
 * Time: 11:32 AM
 */

namespace App\Services\EventService\CreateEvent;

use App\Services\UserService\FindUser\FindUser;
use App\UserEvent;
use App\Event;
use App\Services\EventService\CreateEvent\ValueObjects\EventValueObjects;
use App\Repository\EventRepository;
use App\Repository\UserEventRepository;

class CreateEvent
{
    /**
     * @var FindUser
     */
    public $findUser;
    public $eventRepository;
    public $userEventRepository;

    public function __construct(FindUser $findUser,EventRepository $eventRepository,UserEventRepository $userEventRepository)
    {
        $this->findUser = $findUser;
        $this->eventRepository = $eventRepository;
        $this->userEventRepository = $userEventRepository;
    }

    public function Create(EventValueObjects $valuObjects):Event
    {
        $event = $this->eventRepository->createEvent($valuObjects->getName(),$valuObjects->getDueDate(),$valuObjects->getOwner()->id);
        $users = $this->findUser->byUsername($valuObjects->getInvitedUsernames());
        if($users->count() > 0)
            $user_events= $this->userEventRepository->inviteToEvent($users,$event);

        return $event;

    }

}