@extends('admin.layouts.master')

@section('title')
    بيانات الطلاب
@endsection

@section('content')
    <div class="col-12" style="background-color: white; padding:15px;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="text-align: center; float: none;">بيانات الطلاب</h3>
                <div class="card-tools">
                    {{-- ✅ تم تصحيح المسار إلى students.create --}}
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> إضافة طالب جديد
                    </a>
                </div>
            </div>

            {{-- ✅ رسائل التنبيه --}}
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

            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show position-fixed auto-hide-alert" 
                     id="errorAlert"
                     style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
                     role="alert">
                    <i class="fas fa-times-circle ml-2"></i>
                    <strong>خطأ!</strong> {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- ✅ JavaScript للإخفاء التلقائي --}}
            <script>
                setTimeout(function() {
                    var alerts = document.querySelectorAll('.auto-hide-alert');
                    alerts.forEach(function(alert) {
                        alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateX(-50%) translateY(-20px)';
                        setTimeout(function() { alert.remove(); }, 500);
                    });
                }, 4000);
            </script>

            <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-bordered table-hover" id="example2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th>الدولة</th>
                            <th>العنوان</th>
                            <th>معلومات التواصل</th>
                            <th>صورة الطالب</th>
                            <th>ملاحظات</th>
                            <th>التفعيل</th>
                            <th>تاريخ الإضافة</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student as $info)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $info->name }}</td>
                                
                                {{-- ✅ التصحيح الجوهري: استدعاء العلاقة country ثم الخاصية name --}}
                                <td>{{ $info->country->name ?? 'غير محدد' }}</td>
                                
                                {{-- ✅ إضافة ?? للحماية من القيم الفارغة (Null) --}}
                                <td>{{ $info->address ?? 'غير متوفر' }}</td>
                                <td>{{ $info->phone ?? 'غير متوفر' }}</td>
                                <td><img src="{{ asset('uploads/'.$info->image) }}" alt="avatar logo" style="height:40px;width:40px;"></td>
                                <td>{{ $info->notes ?? '-' }}</td>
                                
                                <td>
                                    @if($info->active == 1)
                                        <span class="badge badge-success">مفعل</span>
                                    @else
                                        <span class="badge badge-danger">معطل</span>
                                    @endif
                                </td>
                                <td>
                                    {{ optional($info->created_at)->format('Y-m-d') ?? '-' }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        {{-- ✅ تم تصحيح المسار إلى students.edit --}}
                                        <a href="{{ route('students.edit', $info->id) }}" class="btn btn-sm btn-warning" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        {{-- ✅ تم تصحيح المسار والنص إلى students.destroy وحذف الطالب --}}
                                        <form action="{{ route('students.destroy', $info->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    title="حذف"
                                                    onclick="return confirm('⚠️ هل أنت متأكد من حذف الطالب:\n\n«{{ $info->name }}»؟\n\nهذا الإجراء لا يمكن التراجع عنه!')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted" style="padding: 20px;">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p>لا توجد بيانات طلاب لعرضها</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection