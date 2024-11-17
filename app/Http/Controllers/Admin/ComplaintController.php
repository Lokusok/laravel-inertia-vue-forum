<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::query()->get();

        $complaints = ComplaintResource::collection($complaints)->resolve();

        return inertia('Admin/Complaint/Index', compact('complaints'));
    }
}
