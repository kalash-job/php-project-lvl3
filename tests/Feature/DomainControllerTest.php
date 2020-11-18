<?php

namespace Tests\Feature;

use Database\Seeders\DomainsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DomainControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DomainsTableSeeder::class);
    }

    public function testIndex()
    {
        $response = $this->get(route('domains.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('domains.create'));
        $response->assertOk();
    }

    public function testShow()
    {
        $response = $this->get(route('domains.show', ['id' => 4]));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = ["name" => "http://htmlbook.ru"];
        $response = $this->post(route('domains.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domains', $data);
    }
}
