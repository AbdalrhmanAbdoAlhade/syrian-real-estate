@extends('layouts.admin')
@section('title', 'إضافة مشرف')
@section('content')
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-2xl font-black">إضافة مشرف جديد</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">سيتمكن الحساب الجديد من إدارة العقارات والإعدادات</p>
  </div>
  <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-arrow-right text-gray-400"></i> رجوع</a>
</div>
<form method="POST" action="{{ route('admin.admins.store') }}" class="bg-white rounded-2xl border shadow-sm p-6 sm:p-8 space-y-4 max-w-xl">
  @csrf
  <div>
    <label class="block text-sm font-black mb-1.5">الاسم <span class="text-brand-600">*</span></label>
    <input type="text" name="name" value="{{ old('name') }}" required placeholder="اسم المشرف" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('name') border-red-400 @enderror">
    @error('name')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm font-black mb-1.5">البريد الإلكتروني <span class="text-brand-600">*</span></label>
    <input type="email" dir="ltr" name="email" value="{{ old('email') }}" required placeholder="admin@example.com" class="w-full border rounded-xl px-4 py-2.5 text-sm text-left focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('email') border-red-400 @enderror">
    @error('email')<p class="text-red-600 text-xs font-bold mt-1"><i class="fa-solid fa-circle-exclamation ml-1"></i>{{ $message }}</p>@enderror
  </div>
  <div class="grid sm:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-black mb-1.5">كلمة المرور <span class="text-brand-600">*</span></label>
      <input type="password" name="password" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 @error('password') border-red-400 @enderror">
      @error('password')<p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="block text-sm font-black mb-1.5">تأكيد كلمة المرور <span class="text-brand-600">*</span></label>
      <input type="password" name="password_confirmation" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
    </div>
  </div>
  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500 text-white py-3 rounded-2xl font-black shadow"><i class="fa-solid fa-user-plus"></i> إنشاء الحساب</button>
</form>
@endsection
