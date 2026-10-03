@extends('admin.layouts.master')

@section('title')
    اضافة طالب للدورة
@endsection

@section('content')
    <div class="col-md-8 mx-auto" style="background-color: white; padding: 20px; border-radius: 8px;">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-plus ml-2"></i>  اضافة طالب للدورة
                </h3>
            </div>

            <form action="{{ route('trainings.store_student', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    {{-- حقل اسم الطالب --}}
                    <div class="form-group">
                        <label for="StudentID"> بيانات الطلاب <span class="text-danger">*</span></label>
                        <select name="student_id" id="StudentID" class="form-control @error('student_id') is-invalid @enderror" required>
                            <option value="">اختر طالباً</option>
                            @foreach($students as $info)
                                <option value="{{ $info->id }}" {{ old('student_id') == $info->id ? 'selected' : '' }}>
                                    {{ $info->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

            
                    {{-- حقل رقم الهوية --}}
                    <div class="form-group">
                        <label for="enrolements_date">تاريخ تسجيله بالدورة  <span class="text-danger">*</span></label>
                        <input type="date" name="enrolements_date" id="enrolements_date" class="form-control @error('enrolements_date') is-invalid @enderror"
                               value="{{ old('enrolements_date')  ?? date('Y-m-d') }}" placeholder="أدخل تاريخ تسجيل الطالب">
                        @error('enrolements_date')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save ml-1"></i> اضف الطالب
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times ml-1"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ كود الجافاسكربت السحري لعرض اسم الملف ومعاينة الصورة --}}
    <script>
        function previewImage(input) {
            const label = document.getElementById('photoLabel');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // 1. عرض اسم الملف في مكان الزر
                label.innerText = file.name;

                // 2. عرض معاينة للصورة
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                // إعادة الوضع لطبيعته إذا ألغى المستخدم الاختيار
                label.innerText = 'اختر ملف صورة';
                previewContainer.style.display = 'none';
                previewImage.src = '#';
            }
        }
    </script>
@endsection