@extends('layouts.admin')
@section('title', 'روابط التواصل')
@section('content')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
  <div>
    <h2 class="text-2xl font-black">روابط التواصل</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">إجمالي {{ $socialLinks->total() }} رابط — تظهر الروابط المفعّلة في تذييل الموقع</p>
  </div>
  <div class="flex gap-2">
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-gauge-high text-gray-400"></i> الرئيسية</a>
    <a href="{{ route('admin.social-links.create') }}" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow"><i class="fa-solid fa-plus"></i> إضافة رابط</a>
  </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-sm min-w-[900px]">
      <thead>
        <tr class="bg-gray-950 text-white text-xs">
          <th class="px-5 py-3.5 text-right font-black">المنصة</th>
          <th class="px-5 py-3.5 text-right font-black">العنوان</th>
          <th class="px-5 py-3.5 text-right font-black">الرابط</th>
          <th class="px-5 py-3.5 text-right font-black">الترتيب</th>
          <th class="px-5 py-3.5 text-right font-black">الحالة</th>
          <th class="px-5 py-3.5 text-right font-black">إجراءات</th>
        </tr>
      </thead>
      <tbody>
        @forelse($socialLinks as $socialLink)
          <tr class="border-b last:border-0 hover:bg-brand-50/50 transition">
            <td class="px-5 py-3.5">
              <div class="flex items-center gap-2 font-black">
                <span class="w-9 h-9 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center">
                  @include('partials.social-icon', ['platform' => $socialLink->platform])
                </span>
                <span>{{ \Illuminate\Support\Str::headline($socialLink->platform) }}</span>
              </div>
            </td>
            <td class="px-5 py-3.5">
              <div class="font-bold">{{ $socialLink->label }}</div>
              @if($socialLink->label_ar || $socialLink->label_en)
                <div class="text-[11px] text-gray-400 font-semibold">
                  {{ $socialLink->label_ar ?: '—' }} / {{ $socialLink->label_en ?: '—' }}
                </div>
              @endif
            </td>
            <td class="px-5 py-3.5">
              <a href="{{ $socialLink->url }}" target="_blank" rel="noopener noreferrer" dir="ltr" class="block max-w-[280px] truncate text-left text-blue-600 hover:underline font-semibold" title="{{ $socialLink->url }}">{{ $socialLink->url }}</a>
            </td>
            <td class="px-5 py-3.5 font-black text-gray-600">{{ $socialLink->sort_order }}</td>
            <td class="px-5 py-3.5">
              <form method="POST" action="{{ route('admin.social-links.toggle', $socialLink) }}">
                @csrf @method('PATCH')
                <button class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black {{ $socialLink->is_active ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}" title="{{ $socialLink->is_active ? 'تعطيل الرابط' : 'تفعيل الرابط' }}">
                  <i class="fa-solid {{ $socialLink->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                  {{ $socialLink->is_active ? 'مفعّل' : 'معطّل' }}
                </button>
              </form>
            </td>
            <td class="px-5 py-3.5">
              <div class="flex items-center gap-1.5">
                <form method="POST" action="{{ route('admin.social-links.move', ['socialLink' => $socialLink, 'direction' => 'up']) }}">
                  @csrf
                  <button title="تحريك لأعلى" class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600"><i class="fa-solid fa-arrow-up text-xs"></i></button>
                </form>
                <form method="POST" action="{{ route('admin.social-links.move', ['socialLink' => $socialLink, 'direction' => 'down']) }}">
                  @csrf
                  <button title="تحريك لأسفل" class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600"><i class="fa-solid fa-arrow-down text-xs"></i></button>
                </form>
                <a href="{{ route('admin.social-links.edit', $socialLink) }}" title="تعديل" class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600"><i class="fa-solid fa-pen text-xs"></i></a>
                <form method="POST" action="{{ route('admin.social-links.destroy', $socialLink) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا الرابط؟')">
                  @csrf @method('DELETE')
                  <button title="حذف" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600"><i class="fa-solid fa-trash text-xs"></i></button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-5 py-14 text-center">
              <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300 text-2xl mb-3"><i class="fa-solid fa-share-nodes"></i></div>
              <p class="font-black text-gray-500">لا توجد روابط تواصل بعد</p>
              <a href="{{ route('admin.social-links.create') }}" class="inline-block mt-3 text-sm font-bold text-brand-600 hover:underline">أضف أول رابط الآن</a>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@if($socialLinks->hasPages())
  <div class="mt-6 flex justify-center">{{ $socialLinks->links() }}</div>
@endif
@endsection
