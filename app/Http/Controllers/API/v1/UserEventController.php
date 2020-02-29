<?php

namespace App\Http\Controllers\API\v1;

use App\UserEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\UserEventRepository;

class UserEventController extends Controller
{
    protected $repository;
    public function __construct(UserEventRepository $repository)
    {
        $this->repository =$repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $UserEvents=$this->repository->UserInvitedEvents(\auth()->id())->toArray();

        foreach ($UserEvents as $key => $row)
            $UserEvents[$key]['status'] = UserEvent::StatusName($row['status']);


        return response()->json([
            'message' => 'successful',
            'data' => $UserEvents
        ]);
    }


    public function accept(UserEvent $userEvent)
    {
        if($userEvent->user_id == \auth()->id())
            $this->repository->AcceptEvents($userEvent->id);
        else
            return abort(404);

        return response()->json([
            'message' => 'successful'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\UserEvent  $userEvent
     * @return \Illuminate\Http\Response
     */
    public function decline(UserEvent $userEvent)
    {
        if($userEvent->user_id == \auth()->id())
            $this->repository->DeclineEvents($userEvent->id);

        else
            return abort(404);

        return response()->json([
            'message' => 'successful'
        ]);
    }



}
