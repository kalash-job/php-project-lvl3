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
        $expectedData = [
            'id' => 1,
            'status_code' => 200,
            'h1' => 'Rukodeling.ru',
            'keywords' => 'Квиллинг, Скарпбукинг, товары для хобби, флористика, бумага для квиллинга, инструменты',
            'description' => 'Товары для квиллинга, скрапбукинга и флористики по лучшим ценам.'
        ];
        $responseBody = file_get_contents('tests/fixtures/response.html');

        Http::fake([
            '*' => Http::response($responseBody, 200)
        ]);

        $response = $this->post(route('domains.checks.store', ['id' => 1]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', $expectedData);
    }
}
