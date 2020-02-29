<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Event;
use App\User;
use App\UserEvent;
class EventTest extends TestCase
{
    use WithFaker,RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStoring()
    {
        $data = [
            'name' => $this->faker->sentence,
            'due_date' => '2016-10-1 22:00',
            'username' => [
                $this->faker->email,
                $this->faker->email,
                ],
        ];

        $this->actingAsAdmin()->post(route('event.store'), $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('events', ['name' => $data['name']]);
    }

    public function test_accept_invitation()
    {
        $user =factory(User::class)->create();
        $event =factory(Event::class)->create([
            'owner_id' => $user->id
        ]);
        $userEvent =factory(UserEvent::class)->create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        $this->actingAsAdmin()->post(route('invitation.acccept',['userEvent' => $userEvent->id]))
            ->assertStatus(200);
        $this->assertDatabaseHas('user_events', ['id' => $userEvent->id,'status' => UserEvent::$accepted_status ]);
    }
    public function test_decline_invitation()
    {
        $user =factory(User::class)->create();
        $event =factory(Event::class)->create([
            'owner_id' => $user->id
        ]);
        $userEvent =factory(UserEvent::class)->create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        $this->actingAsAdmin()->post(route('invitation.decline',['userEvent' => $userEvent->id]))
            ->assertStatus(200);
        $this->assertDatabaseHas('user_events', ['id' => $userEvent->id,'status' => UserEvent::$declined_status ]);
    }
}
