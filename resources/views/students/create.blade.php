@extends('admin.layouts.master')

@section('title')
    إضافة طالب جديد
@endsection

@section('content')
    <div class="col-md-8 mx-auto" style="background-color: white; padding: 20px; border-radius: 8px;">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-plus ml-2"></i> إضافة طالب جديد
                </h3>
            </div>

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    {{-- حقل اسم الطالب --}}
                    <div class="form-group">
                        <label for="name">اسم الطالب <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="أدخل اسم الطالب" required>
                        @error('name')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- حقل الدولة (القائمة المنسدلة) --}}
                    <div class="form-group">
                        <label for="country_id">الدولة <span class="text-danger">*</span></label>
                        <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror" required>
                            <option value="">-- اختر الدولة --</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                           {{-- حقل العنوان --}}
                    <div class="form-group">
                        <label for="nationalID">رقم الهوبة</label>
                        <input type="text" name="nationalID" id="nationalID" class="form-control @error('nationalID') is-invalid @enderror"
                               value="{{ old('nationalID') }}" placeholder="أدخل هوية الطالب">
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
                               value="{{ old('phone') }}" placeholder="أدخل رقم الهاتف ">
                        @error('phones')
                            <span class="invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                      <!-- حقل رفع الملف -->
                     <label for="photo">صورة الكورس</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input
                                type="file"
                                name="photo"
                                class="custom-file-input @error('photo') is-invalid @enderror"
                                id="photo"
                                accept="image/*"
                            >
                            <label class="custom-file-label" for="photo">اختر ملف</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">رفع</span>
                        </div>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="form-text text-muted">
                        الصيغ المسموحة: JPG, PNG, GIF (الحد الأقصى: 2MB)
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
@endsection
