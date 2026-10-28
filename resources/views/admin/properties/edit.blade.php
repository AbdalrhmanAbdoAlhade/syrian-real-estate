@extends('layouts.admin')
@section('title', 'تعديل عقار')
@section('content')
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-2xl font-black">تعديل العقار</h2>
    <p class="text-sm text-gray-500 font-semibold mt-1">{{ $property->title }}</p>
  </div>
  <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center gap-2 bg-white border px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50"><i class="fa-solid fa-arrow-right text-gray-400"></i> رجوع</a>
</div>
<form id="propertyForm" data-ajax-form method="POST" action="{{ route('admin.properties.update', $property) }}" enctype="multipart/form-data" class="space-y-5 max-w-3xl">
  @csrf @method('PUT')
  @include('admin.properties._form', ['property' => $property, 'defaultPhone' => $property->phone, 'sections' => $sections ?? collect()])
  <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-gray-950 hover:bg-gray-800 text-white py-3.5 rounded-2xl font-black shadow"><i class="fa-solid fa-pen-to-square"></i> تحديث العقار</button>
</form>
@endsection
