<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Bar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BarController
 */
final class BarControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $bars = Bar::factory()->count(3)->create();

        $response = $this->get(route('bars.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BarController::class,
            'store',
            \App\Http\Requests\BarStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $location = fake()->word();
        $city = fake()->city();
        $postal_code = fake()->postcode();
        $latitude = fake()->latitude();
        $longitude = fake()->longitude();
        $description = fake()->text();

        $response = $this->post(route('bars.store'), [
            'name' => $name,
            'location' => $location,
            'city' => $city,
            'postal_code' => $postal_code,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'description' => $description,
        ]);

        $bars = Bar::query()
            ->where('name', $name)
            ->where('location', $location)
            ->where('city', $city)
            ->where('postal_code', $postal_code)
            ->where('latitude', $latitude)
            ->where('longitude', $longitude)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $bars);
        $bar = $bars->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->get(route('bars.show', $bar));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BarController::class,
            'update',
            \App\Http\Requests\BarUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $bar = Bar::factory()->create();
        $name = fake()->name();
        $location = fake()->word();
        $city = fake()->city();
        $postal_code = fake()->postcode();
        $latitude = fake()->latitude();
        $longitude = fake()->longitude();
        $description = fake()->text();

        $response = $this->put(route('bars.update', $bar), [
            'name' => $name,
            'location' => $location,
            'city' => $city,
            'postal_code' => $postal_code,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'description' => $description,
        ]);

        $bar->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $bar->name);
        $this->assertEquals($location, $bar->location);
        $this->assertEquals($city, $bar->city);
        $this->assertEquals($postal_code, $bar->postal_code);
        $this->assertEquals($latitude, $bar->latitude);
        $this->assertEquals($longitude, $bar->longitude);
        $this->assertEquals($description, $bar->description);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->delete(route('bars.destroy', $bar));

        $response->assertNoContent();

        $this->assertModelMissing($bar);
    }
}
