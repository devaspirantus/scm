@extends('admin.layouts.master')

@section('title')
    إضافة كورس
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
            <h3 class="card-title">إضافة دورة جديد</h3>
        </div>
        
        <!-- ✅ إضافة enctype للرفع -->
        <form role="form" method="POST" action="{{ route('trainings.update',$data['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- حقل اسم الكورس -->
                <div class="form-group">
                    <label for="courseID">الكورس المخصص للدورة<span style="color: red;">*</span></label>
                    <select name="courseID" id="courseID" class="form-control">
                        <option value="">اختر كورس</option>
                        @if (!@empty($courses))
                            @foreach ($courses as $info)
                                <option value="{{ $info->id }}" @if (old('courseID',$data['courseID'] == $info->id))
                                    selected
                                @endif>{{$info->name}}</option>
                            @endforeach                            
                        @endif
                    </select>
                    @error('courseID')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- حقل الرابط -->
                <div class="form-group">
                    <label for="price">سعر الدورة</label>
                    <input 
                        type="number" 
                        name="price" 
                        class="form-control @error('price') is-invalid @enderror" 
                        id="price" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');"
                        placeholder="100 ريال" 
                        value="{{ old('price',$data['price']) }}"
                    >
                    @error('price')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- حقل الحالة -->
                <div class="form-group">
                    <label for="start_date">تاريخ بداية الدورة <span style="color: red;">*</span></label>
       <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date',$data['start_date']) }}">
                    @error('start_date')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                              <!-- حقل الحالة -->
                <div class="form-group">
                    <label for="end_date">تاريخ نهاية الدورة <span style="color: red;">*</span></label>
       <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date',$data['end_date']) }}">
                    @error('end_date')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                                              <!-- حقل الحالة -->
                <div class="form-group">
                    <label for="notes">ملاحظات <span style="color: red;">*</span></label>
       <input type="text" name="notes" id="notes" class="form-control" value="{{ old('notes',$data['notes']) }}">
                    @error('notes')
                        <span class="invalid-feedback" style="display: block;">
                            <strong style="color: red;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

      
            </div>

            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save ml-1"></i>
                    تعديل الدورة
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