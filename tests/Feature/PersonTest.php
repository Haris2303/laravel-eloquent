<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonTest extends TestCase
{
    public function testPerson()
    {
        $person = new Person();
        $person->first_name = "Ucup";
        $person->last_name = "Surucup";
        $person->save();

        $this->assertEquals("UCUP Surucup", $person->full_name);

        $person->full_name = "Otong Surotong";
        $person->save();

        $this->assertEquals("OTONG", $person->first_name);
        $this->assertEquals("Surotong", $person->last_name);
    }

    public function testAttributeCasting()
    {
        $person = new Person();
        $person->first_name = "Ucup";
        $person->last_name = "Surucup";
        $person->save();

        $this->assertNotNull($person->created_at);
        $this->assertNotNull($person->updated_at);
        $this->assertInstanceOf(Carbon::class, $person->created_at);
        $this->assertInstanceOf(Carbon::class, $person->updated_at);
    }

    public function testCustomCasts()
    {
        $person = new Person();
        $person->first_name = "Ucup";
        $person->last_name = "Surucup";
        $person->address = new Address("Jalan Sepi", "Sorong", "Indonesia", "1231");
        $person->save();

        $this->assertNotNull($person->created_at);
        $this->assertNotNull($person->updated_at);
        $this->assertInstanceOf(Carbon::class, $person->created_at);
        $this->assertInstanceOf(Carbon::class, $person->updated_at);
        $this->assertEquals("Jalan Sepi", $person->address->street);
        $this->assertEquals("Sorong", $person->address->city);
        $this->assertEquals("Indonesia", $person->address->country);
        $this->assertEquals("1231", $person->address->postal_code);
    }
}
