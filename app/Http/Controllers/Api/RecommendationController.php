<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RecommendationStoreRequest;
use App\Http\Requests\RecommendationUpdateRequest;
use App\Http\Resources\RecommendationCollection;
use App\Http\Resources\RecommendationResource;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecommendationController extends Controller
{
    public function index(Request $request): RecommendationCollection
    {
        $recommendations = Recommendation::all();

        return new RecommendationCollection($recommendations);
    }

    public function store(RecommendationStoreRequest $request): RecommendationResource
    {
        $recommendation = Recommendation::create($request->validated());

        return new RecommendationResource($recommendation);
    }

    public function show(Request $request, Recommendation $recommendation): RecommendationResource
    {
        return new RecommendationResource($recommendation);
    }

    public function update(RecommendationUpdateRequest $request, Recommendation $recommendation): RecommendationResource
    {
        $recommendation->update($request->validated());

        return new RecommendationResource($recommendation);
    }

    public function destroy(Request $request, Recommendation $recommendation): Response
    {
        $recommendation->delete();

        return response()->noContent();
    }
}
