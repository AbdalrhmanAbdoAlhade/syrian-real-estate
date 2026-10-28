<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::withCount('properties')->latest()->paginate(15);

        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(StoreSectionRequest $request)
    {
        Section::create($request->validated());

        return redirect()->route('admin.sections.index')->with('success', 'تم إضافة القسم بنجاح.');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->validated());

        return redirect()->route('admin.sections.index')->with('success', 'تم تحديث القسم بنجاح.');
    }

    public function destroy(Section $section)
    {
        DB::transaction(function () use ($section) {
            $section->properties()->detach();
            $section->delete();
        });

        return redirect()->route('admin.sections.index')->with('success', 'تم حذف القسم. لم يتم حذف أي عقار.');
    }
}
