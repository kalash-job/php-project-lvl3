<?php

namespace Tests\Feature;

use Database\Seeders\DomainsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class DomainCheckControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DomainsTableSeeder::class);
    }

    public function testStore()
    {
        Http::fake();
        $response = $this->post(route('domains.checks.store', ['id' => 1]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', ['id' => 1, 'status_code' => 200]);
    }
}
