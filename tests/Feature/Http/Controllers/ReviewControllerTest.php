<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReviewController
 */
final class ReviewControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $reviews = Review::factory()->count(3)->create();

        $response = $this->get(route('reviews.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReviewController::class,
            'store',
            \App\Http\Requests\ReviewStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $rate = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('reviews.store'), [
            'rate' => $rate,
        ]);

        $reviews = Review::query()
            ->where('rate', $rate)
            ->get();
        $this->assertCount(1, $reviews);
        $review = $reviews->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $review = Review::factory()->create();

        $response = $this->get(route('reviews.show', $review));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReviewController::class,
            'update',
            \App\Http\Requests\ReviewUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $review = Review::factory()->create();
        $rate = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('reviews.update', $review), [
            'rate' => $rate,
        ]);

        $review->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($rate, $review->rate);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $review = Review::factory()->create();

        $response = $this->delete(route('reviews.destroy', $review));

        $response->assertNoContent();

        $this->assertModelMissing($review);
    }
}
