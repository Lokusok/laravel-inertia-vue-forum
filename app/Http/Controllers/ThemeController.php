<?php

namespace App\Http\Controllers;

use App\Http\Requests\Theme\StoreRequest;
use App\Http\Requests\Theme\UpdateRequest;
use App\Http\Resources\Theme\ThemeResource;
use App\Http\Resources\Theme\ThemeWithMessagesResource;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Theme::query()->create($data);

        return redirect()->route('branches.show', $data['branch_id']);
    }

    public function show(Theme $theme)
    {
        $theme = ThemeWithMessagesResource::make($theme)->resolve();

        return inertia('Theme/Show', compact('theme'));
    }

    public function edit(Theme $theme)
    {
        $theme = ThemeResource::make($theme)->resolve();

        return inertia('Theme/Edit', compact('theme'));
    }

    public function update(UpdateRequest $request, Theme $theme)
    {
        $data = $request->validated();

        $theme->update($data);

        return redirect()->route('branches.show', $theme->branch->id);
    }

    public function destroy(Theme $theme)
    {
        $theme->delete();

        return redirect()->route('branches.show', $theme->branch->id);
    }
}
