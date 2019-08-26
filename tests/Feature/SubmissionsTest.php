<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmissionsTest extends TestCase
{

    use WithFaker;
    // use RefreshDatabase;

    /** @test */
    public function guests_can_apply() {

        // $this->withoutExceptionHandling();

        function localize_us_number($phone) {
            $numbers_only = preg_replace("/[^\d]/", "", $phone);
            return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
        }
        $answers = ["Yes", "No"];

        $attributes = [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'city'          => $this->faker->city,
            'state'         => $this->faker->stateAbbr,
            'zipcode'       => substr($this->faker->postcode, 0, 5),
            'email'         => $this->faker->email,
            'phone'         => localize_us_number(rand('1111111111', '9999999999')),
            'cdla'          => $answers[rand(0,1)],
            'experience'    => $answers[rand(0,1)],
            'confirm'       => 1,
        ];

        $this->post("/", $attributes);
        $this->assertDatabaseHas("submissions", $attributes);

    }
    
}
