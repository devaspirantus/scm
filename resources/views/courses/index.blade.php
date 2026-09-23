@extends('admin.layouts.master')

@section('title')
    الكورسات
@endsection

@section('content')
    <div class="col-12" style="background-color: white; padding:15px;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="text-align: center; float: none;">بيانات الكورسات</h3>
                <div class="card-tools">
                    <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> إضافة كورس جديد
                    </a>
                </div>
            </div>

            {{-- ✅ رسالة النجاح --}}
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show position-fixed auto-hide-alert" 
                     id="successAlert"
                     style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
                     role="alert">
                    <i class="fas fa-check-circle ml-2"></i>
                    <strong>نجح!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            {{-- ✅ رسالة التحذير --}}
            @if(Session::has('warning'))
                <div class="alert alert-warning alert-dismissible fade show position-fixed auto-hide-alert" 
                     id="warningAlert"
                     style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
                     role="alert">
                    <i class="fas fa-exclamation-triangle ml-2"></i>
                    <strong>تحذير!</strong> {{ Session::get('warning') }}
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

            <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-bordered table-hover" id="example2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الكورس</th>
                            <th>الرابط</th>
                            <th>الحالة</th>
                            <th>تاريخ الإضافة</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $info)
                            <tr>
                                <td>{{ $info->id }}</td>
                                <td>{{ $info->name }}</td>
                                <td>
                                    @if($info->link)
                                        <a href="{{ $info->link }}" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fas fa-external-link-alt"></i> فتح
                                        </a>
                                    @else
                                        <span class="text-muted">لا يوجد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($info->active == 1)
                                        <span class="badge badge-success">مفعل</span>
                                    @else
                                        <span class="badge badge-danger">معطل</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $info->created_at->format('Y-m-d') }}
                                </td>
                                <th>
                                    <a href="#" class="button" style="background-color: green;color:white; padding:10px;">تعديل</a>
                                    <a href="#" class="button" style="background-color: red;color:white; padding:10px;">حذف</a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted" style="padding: 20px;">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p>لا توجد بيانات لعرضها</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection