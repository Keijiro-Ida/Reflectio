<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReflectionRequest;
use App\Http\Requests\UpdateReflectionRequest;
use App\UseCases\Reflection\CreateReflectionUseCase;
use App\UseCases\Reflection\UpdateReflectionUseCase;
use App\UseCases\Reflection\DeleteReflectionUseCase;
use Illuminate\Support\Facades\Log;


class ReflectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reflections = auth()->user()->reflections()->latest()->get();

        return response()->json($reflections);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
 * Store a newly created resource in storage.
     */
    public function store(StoreReflectionRequest $request, CreateReflectionUseCase $usecase)
    {
        $reflection = $usecase->handle(auth()->user(), $request->toDto());

        return response()->json($reflection, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reflection $reflection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reflection $reflection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReflectionRequest $request,  int $reflection_id, UpdateReflectionUseCase $usecase)
    {

        $reflection = $usecase->handle(auth()->user(), $reflection_id, $request->toDto());

        return response()->json($reflection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $reflection_id, DeleteReflectionUseCase $usecase)
    {
        $usecase->handle(auth()->user(), $reflection_id);
        return response()->json(null, 204);
    }
}
