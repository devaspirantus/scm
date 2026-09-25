@extends('admin.layouts.master')

@section('title')
    إضافة طالب
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
            <h3 class="card-title"> إضافة طالب جديد</h3>
        </div>
        
        <!-- ✅ إضافة enctype للرفع -->
        <form role="form" method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="card-body">
                <!-- حقل اسم الكورس -->
                <div class="form-group">
                    <label for="name">اسم الطالب <span style="color: red;">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        placeholder="ادخل اسم الطالب" 
                        value="{{ old('name') }}"
                        autofocus
                    >
                    @error('name')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                         <!-- حقل اسم الدولة -->
                <div class="form-group">
                    <label for="country_id">اسم الدولة <span style="color: red;">*</span></label>
                    <input 
                        type="text" 
                        name="country_id" 
                        class="form-control @error('country_id') is-invalid @enderror" 
                        id="name" 
                        placeholder="ادخل اسم الدولة" 
                        value="{{ old('countries') }}"
                        autofocus
                    >
                    @error('country_id')
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
                    إضافة الطالب
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
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