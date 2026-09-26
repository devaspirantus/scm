@extends('admin.layouts.master')

@section('title')
    تعديل بيانات الطالب
@endsection

@section('content')
    <div class="col-md-8 mx-auto" style="background-color: white; padding: 20px; border-radius: 8px;">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-edit ml-2"></i> 
                    تعديل بيانات الطالب: {{ $student->name }}
                </h3>
            </div>

            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    {{-- حقل اسم الطالب --}}
                    <div class="form-group">
                        <label for="name">اسم الطالب <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" 
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $student->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل الدولة --}}
                    <div class="form-group">
                        <label for="country_id">الدولة <span class="text-danger">*</span></label>
                        <select name="country_id" id="country_id" 
                                class="form-control @error('country_id') is-invalid @enderror" required>
                            <option value="">-- اختر الدولة --</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" 
                                    {{ old('country_id', $student->country_id) == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل رقم الهوية --}}
                    <div class="form-group">
                        <label for="nationalID">رقم الهوية <span class="text-danger">*</span></label>
                        <input type="text" name="nationalID" id="nationalID"  
                               class="form-control @error('nationalID') is-invalid @enderror"
                               value="{{ old('nationalID', $student->nationalID) }}" readonly>
                        @error('nationalID')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل العنوان --}}
                    <div class="form-group">
                        <label for="address">العنوان</label>
                        <input type="text" name="address" id="address" 
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $student->address) }}">
                        @error('address')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل الهاتف --}}
                    <div class="form-group">
                        <label for="phone">معلومات التواصل</label>
                        <input type="text" name="phone" id="phone" 
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $student->phone) }}">
                        @error('phone')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل الصورة --}}
                    <div class="form-group">
                        <label for="photo">صورة الطالب</label>
                        
                        @if($student->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="الصورة الحالية" 
                                     style="max-width: 100px; max-height: 100px; border-radius: 8px; border: 2px solid #ddd;">
                                <small class="d-block text-muted">الصورة الحالية</small>
                            </div>
                        @endif

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" 
                                       class="custom-file-input @error('photo') is-invalid @enderror"
                                       id="photo" accept="image/*" onchange="previewImage(this)">
                                <label class="custom-file-label" for="photo" id="photoLabel">
                                    تغيير الصورة (اختياري)
                                </label>
                            </div>
                        </div>
                        @error('photo')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                        
                        <div id="imagePreviewContainer" class="mt-2" style="display: none;">
                            <img id="imagePreview" src="#" alt="معاينة" 
                                 style="max-width: 100px; border-radius: 8px;">
                        </div>
                    </div>

                    {{-- حقل الملاحظات --}}
                    <div class="form-group">
                        <label for="notes">ملاحظات</label>
                        <textarea name="notes" id="notes" 
                                  class="form-control @error('notes') is-invalid @enderror" 
                                  rows="3">{{ old('notes', $student->notes) }}</textarea>
                        @error('notes')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل حالة التفعيل --}}
                    <div class="form-group">
                        <label for="active">حالة التفعيل</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" {{ old('active', $student->active) == '1' ? 'selected' : '' }}>
                                مفعل
                            </option>
                            <option value="0" {{ old('active', $student->active) == '0' ? 'selected' : '' }}>
                                معطل
                            </option>
                        </select>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning text-dark">
                        <i class="fas fa-save ml-1"></i> حفظ التعديلات
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times ml-1"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const label = document.getElementById('photoLabel');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                label.innerText = input.files[0].name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection