<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BarStoreRequest;
use App\Http\Requests\BarUpdateRequest;
use App\Http\Resources\BarCollection;
use App\Http\Resources\BarResource;
use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BarController extends Controller
{
    public function index(Request $request): BarCollection
    {
        $bars = Bar::all();

        return new BarCollection($bars);
    }

    public function store(BarStoreRequest $request): BarResource
    {
        $bar = Bar::create($request->validated());

        return new BarResource($bar);
    }

    public function show(Request $request, Bar $bar): BarResource
    {
        return new BarResource($bar);
    }

    public function update(BarUpdateRequest $request, Bar $bar): BarResource
    {
        $bar->update($request->validated());

        return new BarResource($bar);
    }

    public function destroy(Request $request, Bar $bar): Response
    {
        $bar->delete();

        return response()->noContent();
    }
}
