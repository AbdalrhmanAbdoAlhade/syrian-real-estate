<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    public function index() {
        $admins = User::where('is_admin', true)->latest()->get();
        return view('admin.admins.index', compact('admins'));
    }
    public function create() {
        return view('admin.admins.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);
        return redirect()->route('admin.admins.index')->with('success', 'تم إنشاء حساب الأدمن بنجاح');
    }
    public function destroy(User $admin) {
        if ($admin->id === auth()->id()) return back()->with('error', 'لا يمكنك حذف حسابك الحالي');
        if (!$admin->is_admin) return back()->with('error', 'المستخدم ليس أدمن');
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'تم حذف الأدمن بنجاح');
    }
}
