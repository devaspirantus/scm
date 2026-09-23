@extends('admin.layouts.master')

@section('title')
    تفاصيل الكورس
@endsection

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-book ml-2"></i>
                {{ $course->name }}
            </h3>
        </div>
        
        <div class="card-body">
            <table class="table">
                <tr>
                    <th style="width: 30%;">رقم الكورس:</th>
                    <td>#{{ $course->id }}</td>
                </tr>
                <tr>
                    <th>الاسم:</th>
                    <td>{{ $course->name }}</td>
                </tr>
                <tr>
                    <th>الرابط:</th>
                    <td>
                        @if($course->link)
                            <a href="{{ $course->link }}" target="_blank">
                                {{ $course->link }}
                            </a>
                        @else
                            <span class="text-muted">لا يوجد رابط</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>الحالة:</th>
                    <td>
                        @if($course->active == 1)
                            <span class="badge badge-success">مفعل</span>
                        @else
                            <span class="badge badge-danger">معطل</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>تاريخ الإضافة:</th>
                    <td>{{ optional($course->created_at)->format('Y-m-d H:i') ?? '-' }}</td>
                </tr>
            </table>
        </div>
        
        <div class="card-footer text-center">
            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">
                <i class="fas fa-edit ml-1"></i> تعديل
            </a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right ml-1"></i> العودة للقائمة
            </a>
        </div>
    </div>
</div>
@endsection