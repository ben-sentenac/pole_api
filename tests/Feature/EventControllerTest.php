<?php

use App\Models\User;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('GET /events should respond 200', function () {
    $this->seed();
    $response = $this->getJson('/api/events');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data'=>[
            "*" => [
                "id",
                "name",
                "description",
                "start_time",
                "end_time"
            ]
        ],
    ]);
    $response->assertJsonCount(3);
});

test('GET /events?include=attendees,user should includes resource', function () {
    $this->seed();
    $response = $this->getJson('/api/events?include=attendees,user');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data'=>[
            "*" => [
                "id",
                "name",
                "description",
                "start_time",
                "end_time",
                "user",
                "attendees"
            ]
        ],
    ]);
    $response->assertJsonCount(3);
});

test('POST /events should create resource', function () {
    $this->seed();
    $user = User::find(1)->first();
    $loginResponse = $this->postJson('/api/login',[
        "email" => $user->email,
        "password" => "password"
    ]);
    $response = $this->withHeaders([
        "authorization" => "Bearer {$loginResponse["token"]}"
    ])->postJson('/api/events?include=attendees,user',[
        "name" => "newly created event",
        "description" => "new description",
        "start_time" => "2024-12-11 01:00:00",
        "end_time" => "2024-12-13 01:00:00",
        "user_id" => $user->id,
        "location_id" => Location::find(1)->id
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure(
        [
            "data" => [
                "id",
                "name",
                "description",
                "start_time",
                "end_time"
            ]
        ]
    );
});

