<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ConsumableTypeStoreRequest;
use App\Http\Requests\ConsumableTypeUpdateRequest;
use App\Http\Resources\ConsumableTypeCollection;
use App\Http\Resources\ConsumableTypeResource;
use App\Models\ConsumableType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsumableTypeController extends Controller
{
    public function index(Request $request): ConsumableTypeCollection
    {
        $consumableTypes = ConsumableType::all();

        return new ConsumableTypeCollection($consumableTypes);
    }

    public function store(ConsumableTypeStoreRequest $request): ConsumableTypeResource
    {
        $consumableType = ConsumableType::create($request->validated());

        return new ConsumableTypeResource($consumableType);
    }

    public function show(Request $request, ConsumableType $consumableType): ConsumableTypeResource
    {
        return new ConsumableTypeResource($consumableType);
    }

    public function update(ConsumableTypeUpdateRequest $request, ConsumableType $consumableType): ConsumableTypeResource
    {
        $consumableType->update($request->validated());

        return new ConsumableTypeResource($consumableType);
    }

    public function destroy(Request $request, ConsumableType $consumableType): Response
    {
        $consumableType->delete();

        return response()->noContent();
    }
}
