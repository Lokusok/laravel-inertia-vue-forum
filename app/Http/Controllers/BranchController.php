<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\Section\SectionResource;
use App\Models\Branch;
use App\Models\Section;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return inertia('Branch/Index');
    }

    public function create()
    {
        $sections = Section::query()->get();
        $sections = SectionResource::collection($sections)->resolve();

        return inertia('Branch/Create', compact('sections'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Branch::firstOrCreate($data);

        return redirect()->route('sections.index');
    }

    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
