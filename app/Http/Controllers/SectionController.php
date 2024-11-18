<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\StoreRequest;
use App\Http\Requests\Section\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Models\Branch;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::query()->with('parentBranches')->get();

        $sections = SectionWithBranchesResource::collection($sections)->resolve();

        return inertia('Section/Index', compact('sections'));
    }

    public function create()
    {
        Gate::authorize('create', Section::class);

        return inertia('Section/Create');
    }

    public function store(StoreRequest $request)
    {
        Gate::authorize('create', Section::class);

        $data = $request->validated();

        Section::firstOrCreate($data);

        return redirect()->route('sections.index');
    }

    public function edit(Section $section)
    {
        $section = SectionResource::make($section)->resolve();

        return inertia('Section/Edit', compact('section'));
    }

    public function update(UpdateRequest $request, Section $section)
    {
        $data = $request->validated();

        $section->update($data);

        return redirect()->route('sections.index')->with('message', 'Раздел успешно отредактирован');
    }

    public function destroy(Section $section)
    {
        Gate::authorize('delete', Section::class);

        $section->delete();

        return redirect()->back();
    }

    public function branchesIndex(Section $section)
    {
        $branches = BranchResource::collection($section->branches)->resolve();

        return $branches;
    }

    public function branchExceptIndex(Section $section, Branch $branch)
    {
        $branches = $section->branches()->where('id', '!=', $branch->id)->get();
        $branches = BranchResource::collection($branches)->resolve();

        return $branches;
    }
}
