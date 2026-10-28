@extends('layouts.admin')
@section('title', 'تعديل رابط تواصل')
@section('content')
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-2xl font-black">تعديل رابط التواصل</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">حدّث بيانات الرابط أو حالته وترتيبه</p>
  </div>
  <a href="{{ route('admin.social-links.index') }}" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-arrow-right text-gray-400"></i> رجوع</a>
</div>
<form method="POST" action="{{ route('admin.social-links.update', $socialLink) }}" class="space-y-5 max-w-2xl">
  @csrf @method('PUT')
  @include('admin.social-links._form', ['socialLink' => $socialLink])
  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500 text-white py-3.5 rounded-2xl font-black shadow"><i class="fa-solid fa-floppy-disk"></i> حفظ التعديلات</button>
</form>
@endsection
