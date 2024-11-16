<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Branch\BranchWithChildrenResource;
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
        $branch = BranchWithChildrenResource::make($branch)->resolve();

        return inertia('Branch/Show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        $sections = Section::query()->get();
        $sections = SectionResource::collection($sections)->resolve();

        $branch = BranchResource::make($branch)->resolve();

        return inertia('Branch/Edit', compact('sections', 'branch'));
    }

    public function update(UpdateRequest $request, Branch $branch)
    {
        $data = $request->validated();

        $branch->update($data);

        return redirect()->route('sections.index');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('sections.index');
    }
}
