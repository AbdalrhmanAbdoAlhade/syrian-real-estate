<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Property::count(),
            'active' => Property::where('is_active', true)->count(),
            'hidden' => Property::where('is_active', false)->count(),
            'for_sale' => Property::where('purpose', 'بيع')->count(),
            'for_rent' => Property::where('purpose', 'إيجار')->count(),
        ];
        $recent = Property::with(['media', 'images', 'videos', 'cover', 'sections'])->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }
}
