<?php

namespace App\Http\Controllers\API\v1;

use App\Event;
use App\UserEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EventService\CreateEvent\CreateEvent;
use App\Http\Requests\Event\EventCreateRequest;
use App\Services\EventService\CreateEvent\ValueObjects\EventValueObjects;
use App\Repository\EventRepository;

class EventController extends Controller
{
    protected $repository;
    public function __construct(EventRepository $repository)
    {
        $this->repository= $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->repository->UserEvents(auth()->id());
        return response()->json([
            'message' => 'successful',
            'data' => $events
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCreateRequest $request,CreateEvent $createEvent)
    {
        $evetValue = new EventValueObjects();
        $evetValue->setName($request->name)
            ->setDueDate($request->due_date)
            ->setInvitedUsernames($request->username)
            ->setOwner($request->user());
        $event= $createEvent->Create($evetValue);

        return response()->json([
            'message' => 'successful',
            'data' => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if($event->owner_id == \auth()->id())
            $guests = $this->repository->eventGuests($event->id)->toArray();

        else
            return abort(404);

        foreach ($guests as $key => $row)
            $guests[$key]['status'] = UserEvent::StatusName($row['status']);
        $event = $event->toArray();
        $event['quests'] = $guests;
        return response()->json([
            'message' => 'successful',
            'data' => $event
        ]);
    }

}
