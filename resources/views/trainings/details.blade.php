@extends('admin.layouts.master')

@section('title')
    تفاصيل الدورة التدريبية
@endsection

@section('content')
    <div class="col-md-12">
        {{-- رسائل التنبيه --}}
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed auto-hide-alert" style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px;" role="alert">
                <i class="fas fa-times-circle ml-2"></i> <strong>مع الأسف!</strong> {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed auto-hide-alert" style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px;" role="alert">
                <i class="fas fa-check-circle ml-2"></i> <strong>تم بنجاح!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <script>
            setTimeout(function() {
                document.querySelectorAll('.auto-hide-alert').forEach(alert => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 4000);
        </script>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center w-100">بيانات الدورة التدريبية</h3>
                <div class="card-tools">
                    <a href="{{ route('trainings.add_student', $data['id']) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> إضافة طالب للدورة
                    </a>
                </div>
            </div>

            <form role="form" method="POST" action="{{ route('trainings.update', $data['id']) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>اسم الدورة</label>
                        <input type="text" name="course_name" class="form-control @error('course_name') is-invalid @enderror" value="{{ old('course_name', $data['course_name']) }}">
                        @error('course_name') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="form-group">
                        <label>السعر</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{ old('price', $data['price']) }}">
                        @error('price') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ بداية الدورة <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control" value="{{ $data['start_date'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ نهاية الدورة <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control" value="{{ $data['end_date'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ملاحظات</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $data['notes']) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>عدد الطلاب المسجلين</label>
                        <input type="text" class="form-control" value="{{ $data['studentCounter'] ?? 0 }}" readonly style="background-color: #e9ecef; font-weight: bold;">
                        
                        {{-- ✅ هنا ربطنا الزر بالشاشة الجديدة --}}
                        <a href="{{ route('trainings.students_list', $data['id']) }}" class="btn btn-info btn-block mt-3">
                            <i class="fas fa-users"></i> عرض قائمة الطلاب المسجلين
                        </a>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> حفظ التعديلات</button>
                    <a href="{{ route('trainings.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection