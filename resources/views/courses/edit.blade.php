@extends('admin.layouts.master')

@section('title')
    تعديل كورس
@endsection

@section('content')
<div class="col-md-12">

            {{-- ✅ رسالة الخطأ (منفصلة تماماً) --}}
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show position-fixed auto-hide-alert" 
                     id="errorAlert"
                     style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
                     role="alert">
                    <i class="fas fa-times-circle ml-2"></i>
                    <strong>مع الأسف!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                   {{-- ✅ JavaScript للإخفاء التلقائي --}}
            <script>
                // إخفاء تلقائي بعد 4 ثوانٍ لكل الإشعارات
                setTimeout(function() {
                    var alerts = document.querySelectorAll('.auto-hide-alert');
                    alerts.forEach(function(alert) {
                        alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateX(-50%) translateY(-20px)';
                        
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    });
                }, 4000); // 4000ms = 4 ثوانٍ
            </script>
    <div class="card">
        <div class="card-header" >
            <h3 class="card-title">تعديل كورس جديد</h3>
        </div>
        
        <!-- ✅ إضافة enctype للرفع -->
        <form role="form" method="POST" action="{{ route('courses.update',$data->id) }}" enctype="multipart/form-data">
            @csrf
           @method('PUT')
            <div class="card-body">
                <!-- حقل اسم الكورس -->
                <div class="form-group">
                    <label for="name">اسم الكورس <span style="color: red;">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        placeholder="ادخل اسم الكورس" 
                        value="{{ old('name',$data['name']) }}"
                        autofocus
                    >
                    @error('name')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- حقل الرابط -->
                <div class="form-group">
                    <label for="link">الرابط</label>
                    <input 
                        type="url" 
                        name="link" 
                        class="form-control @error('link') is-invalid @enderror" 
                        id="link" 
                        placeholder="ادخل رابط الكورس (https://...)" 
                        value="{{ old('link',$data['link']) }}"
                    >
                    @error('link')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- حقل الحالة -->
                <div class="form-group">
                    <label for="active">الحالة <span style="color: red;">*</span></label>
                    <select 
                        name="active" 
                        id="active" 
                        class="form-control @error('active') is-invalid @enderror"
                    >
                        <option value="">اختر الحالة</option>
                        <option value="1" {{ old('active',$data['active']) == '1' ? 'selected' : '' }}>مفعل</option>
                        <option value="0" {{ old('active',$data['active']) == '0' ? 'selected' : '' }}>غير مفعل</option>
                    </select>
                    @error('active')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- حقل رفع الملف -->
                {{-- <div class="form-group">
                    <label for="image">صورة الكورس</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input 
                                type="file" 
                                name="image" 
                                class="custom-file-input @error('image') is-invalid @enderror" 
                                id="image"
                                accept="image/*"
                            >
                            <label class="custom-file-label" for="image">اختر ملف</label>
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
                </div> --}}
            </div>

            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save ml-1"></i>
                    تحديث الكورس
                </button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times ml-1"></i>
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript لعرض اسم الملف المختار -->
{{-- <script>
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script> --}}
@endsection