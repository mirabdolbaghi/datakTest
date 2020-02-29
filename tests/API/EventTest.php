<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventTest extends TestCase2
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStoring()
    {
        $this->expectOutputString(''); // tell PHPUnit to expect '' as output
        print_r("Hello World");
        factory(User::class)->create()
//        $data = [
//            'name' => $this->faker->sentence,
//            'duedate' => $this->faker->dateTime,
//            'username' => [
//                $this->faker->email,
//                $this->faker->email,
//                ],
//        ];
        print($this->user->toArray());

//        $this->actingAsAdmin()->post(route('event.store'), $data)
//            ->assertStatus(200);
    }
}
