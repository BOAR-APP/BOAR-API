<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ConsumableStoreRequest;
use App\Http\Requests\ConsumableUpdateRequest;
use App\Http\Resources\ConsumableCollection;
use App\Http\Resources\ConsumableResource;
use App\Models\Consumable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsumableController extends Controller
{
    public function index(Request $request): ConsumableCollection
    {
        $consumables = Consumable::all();

        return new ConsumableCollection($consumables);
    }

    public function store(ConsumableStoreRequest $request): ConsumableResource
    {
        $consumable = Consumable::create($request->validated());

        return new ConsumableResource($consumable);
    }

    public function show(Request $request, Consumable $consumable): ConsumableResource
    {
        return new ConsumableResource($consumable);
    }

    public function update(ConsumableUpdateRequest $request, Consumable $consumable): ConsumableResource
    {
        $consumable->update($request->validated());

        return new ConsumableResource($consumable);
    }

    public function destroy(Request $request, Consumable $consumable): Response
    {
        $consumable->delete();

        return response()->noContent();
    }
}
