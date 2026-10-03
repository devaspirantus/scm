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
                        <label for="nationalID">رقم الهوية <span class="text-danger">*</span></label>
                        <input type="text" name="nationalID" id="nationalID" class="form-control @error('nationalID') is-invalid @enderror"
                               value="{{ old('nationalID') }}" placeholder="أدخل رقم هوية الطالب">
                        @error('nationalID')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل العنوان --}}
                    <div class="form-group">
                        <label for="address">العنوان</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address') }}" placeholder="أدخل عنوان الطالب">
                        @error('address')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل معلومات التواصل --}}
                    <div class="form-group">
                        <label for="phone">معلومات التواصل (هاتف/بريد)</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" placeholder="أدخل رقم الهاتف">
                        @error('phone') {{-- ✅ تم التصحيح هنا --}}
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل رفع الصورة --}}
                    <div class="form-group">
                        <label for="photo">صورة الطالب</label> {{-- ✅ تم التصحيح هنا --}}
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input @error('photo') is-invalid @enderror"
                                       id="photo" accept="image/*" onchange="previewImage(this)">
                                <label class="custom-file-label" for="photo" id="photoLabel">اختر ملف صورة</label>
                            </div>
                        </div>
                        @error('photo') {{-- ✅ تم التصحيح هنا --}}
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                        
                        {{-- ✅ ميزة إضافية: معاينة الصورة فوراً --}}
                        <div id="imagePreviewContainer" class="mt-2" style="display: none;">
                            <img id="imagePreview" src="#" alt="معاينة الصورة" 
                                 style="max-width: 150px; max-height: 150px; border-radius: 8px; border: 2px solid #ddd; object-fit: cover;">
                        </div>
                        
                        <small class="form-text text-muted mt-1">
                            <i class="fas fa-info-circle"></i> الصيغ المسموحة: JPG, PNG, GIF (الحد الأقصى: 2MB)
                        </small>
                    </div>

                    {{-- حقل الملاحظات --}}
                    <div class="form-group">
                        <label for="notes">ملاحظات</label>
                        <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"
                                  rows="3" placeholder="أي ملاحظات إضافية...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل حالة التفعيل --}}
                    <div class="form-group">
                        <label for="active">حالة التفعيل</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" {{ old('active', 1) == '1' ? 'selected' : '' }}>مفعل</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>معطل</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save ml-1"></i> حفظ الطالب
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