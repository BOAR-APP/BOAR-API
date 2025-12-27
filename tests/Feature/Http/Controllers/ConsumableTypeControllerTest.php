<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ConsumableType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ConsumableTypeController
 */
final class ConsumableTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $consumableTypes = ConsumableType::factory()->count(3)->create();

        $response = $this->get(route('consumable-types.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConsumableTypeController::class,
            'store',
            \App\Http\Requests\ConsumableTypeStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();

        $response = $this->post(route('consumable-types.store'), [
            'name' => $name,
        ]);

        $consumableTypes = ConsumableType::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $consumableTypes);
        $consumableType = $consumableTypes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $consumableType = ConsumableType::factory()->create();

        $response = $this->get(route('consumable-types.show', $consumableType));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConsumableTypeController::class,
            'update',
            \App\Http\Requests\ConsumableTypeUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $consumableType = ConsumableType::factory()->create();
        $name = fake()->name();

        $response = $this->put(route('consumable-types.update', $consumableType), [
            'name' => $name,
        ]);

        $consumableType->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $consumableType->name);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $consumableType = ConsumableType::factory()->create();

        $response = $this->delete(route('consumable-types.destroy', $consumableType));

        $response->assertNoContent();

        $this->assertModelMissing($consumableType);
    }
}
