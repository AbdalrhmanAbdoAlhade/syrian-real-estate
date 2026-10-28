@extends('layouts.admin')
@section('title', 'المشرفين')
@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h2 class="text-2xl font-black">المشرفين</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">الحسابات المخوّلة بإدارة المنصة ({{ $admins->count() }})</p>
  </div>
  <a href="{{ route('admin.admins.create') }}" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow"><i class="fa-solid fa-plus"></i> إضافة مشرف</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[560px]">
      <thead><tr class="bg-gray-950 text-white text-xs">
        <th class="px-5 py-3.5 text-right font-black">المشرف</th>
        <th class="px-5 py-3.5 text-right font-black">البريد الإلكتروني</th>
        <th class="px-5 py-3.5 text-right font-black">تاريخ الإنشاء</th>
        <th class="px-5 py-3.5 text-right font-black">إجراءات</th>
      </tr></thead>
      <tbody>
        @forelse($admins as $admin)
          <tr class="border-b last:border-0 hover:bg-brand-50/50 transition">
            <td class="px-5 py-3.5">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-gold text-white flex items-center justify-center font-black">{{ mb_substr($admin->name, 0, 1) }}</div>
                <span class="font-black">{{ $admin->name }}
                  @if($admin->id === auth()->id())<span class="mr-1 text-[11px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-black">أنت</span>@endif
                </span>
              </div>
            </td>
            <td class="px-5 py-3.5 font-semibold text-gray-600" dir="ltr" style="text-align:right">{{ $admin->email }}</td>
            <td class="px-5 py-3.5 text-gray-500 font-semibold">{{ $admin->created_at->format('Y-m-d') }}</td>
            <td class="px-5 py-3.5">
              @if($admin->id !== auth()->id())
                <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المشرف؟')">
                  @csrf @method('DELETE')
                  <button class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-xs font-black"><i class="fa-solid fa-trash"></i> حذف</button>
                </form>
              @else
                <span class="text-gray-300 font-black">—</span>
              @endif
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-5 py-12 text-center text-gray-400 font-bold">لا يوجد مشرفون</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
