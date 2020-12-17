<?php

namespace Tests\Feature;

use Database\Seeders\DomainsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DomainsTableSeeder::class);
    }

    public function testIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
    }
}
