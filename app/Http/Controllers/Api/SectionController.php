<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $sections = Section::withCount('properties')
            ->orderBy('name_ar')
            ->paginate($request->get('per_page', 15));
        $sections->getCollection()->transform(fn ($section) => (new SectionResource($section))->resolve());

        return response()->json($sections);
    }

    public function show(Section $section)
    {
        $section->loadCount('properties');

        return response()->json((new SectionResource($section))->resolve());
    }
}
