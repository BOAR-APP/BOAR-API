<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Bar;
use App\Models\Recommendation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\RecommendationController
 */
final class RecommendationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $recommendations = Recommendation::factory()->count(3)->create();

        $response = $this->get(route('recommendations.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\RecommendationController::class,
            'store',
            \App\Http\Requests\RecommendationStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $bar = Bar::factory()->create();

        $response = $this->post(route('recommendations.store'), [
            'id' => $bar->id,
        ]);

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas('recommendations', [
            'id' => $bar->id,
        ]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $recommendation = Recommendation::factory()->create();

        $response = $this->get(route('recommendations.show', $recommendation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\RecommendationController::class,
            'update',
            \App\Http\Requests\RecommendationUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $recommendation = Recommendation::factory()->create();

        $response = $this->put(route('recommendations.update', $recommendation));

        $recommendation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $recommendation = Recommendation::factory()->create();

        $response = $this->delete(route('recommendations.destroy', $recommendation));

        $response->assertNoContent();

        $this->assertModelMissing($recommendation);
    }
}
