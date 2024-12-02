<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

test('GET /api/courses', function () {
    $response = $this->getJson('/api/courses');

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('data'));
});

test('POST /api/courses should send 422', function () {
        $response = $this->postJson('/api/courses',[
            "name" =>"",
            "description" =>""
        ]);

        $response->assertStatus(422);
});
