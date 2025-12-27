<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Consumable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ConsumableController
 */
final class ConsumableControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $consumables = Consumable::factory()->count(3)->create();

        $response = $this->get(route('consumables.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConsumableController::class,
            'store',
            \App\Http\Requests\ConsumableStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $is_drink = fake()->boolean();

        $response = $this->post(route('consumables.store'), [
            'name' => $name,
            'is_drink' => $is_drink,
        ]);

        $consumables = Consumable::query()
            ->where('name', $name)
            ->where('is_drink', $is_drink)
            ->get();
        $this->assertCount(1, $consumables);
        $consumable = $consumables->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $consumable = Consumable::factory()->create();

        $response = $this->get(route('consumables.show', $consumable));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConsumableController::class,
            'update',
            \App\Http\Requests\ConsumableUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $consumable = Consumable::factory()->create();
        $name = fake()->name();
        $is_drink = fake()->boolean();

        $response = $this->put(route('consumables.update', $consumable), [
            'name' => $name,
            'is_drink' => $is_drink,
        ]);

        $consumable->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $consumable->name);
        $this->assertEquals($is_drink, $consumable->is_drink);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $consumable = Consumable::factory()->create();

        $response = $this->delete(route('consumables.destroy', $consumable));

        $response->assertNoContent();

        $this->assertModelMissing($consumable);
    }
}
