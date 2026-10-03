@extends('admin.layouts.master')

@section('title')
    الطلاب المسجلين في الدورة
@endsection

@section('content')
    <div class="col-md-12">
        
        {{-- ========================================== --}}
        {{-- رسائل التنبيه (محسّنة لدعم العربية والظل) --}}
        {{-- ========================================== --}}
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed auto-hide-alert shadow-sm" 
                 style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px;" role="alert">
                <i class="fas fa-times-circle me-2"></i>
                <strong>تنبيه!</strong> {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed auto-hide-alert shadow-sm" 
                 style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 350px;" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>عملية ناجحة!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <script>
            setTimeout(() => {
                document.querySelectorAll('.auto-hide-alert').forEach(alert => { 
                    alert.style.opacity = '0'; 
                    alert.style.transform = 'translateX(-50%) translateY(-20px)';
                    setTimeout(() => alert.remove(), 500); 
                });
            }, 4000);
        </script>

        {{-- ========================================== --}}
        {{-- بطاقة قائمة الطلاب --}}
        {{-- ========================================== --}}
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="card-title mb-0">
                    <i class="fas fa-users me-2"></i> 
                    الطلاب المسجلين في دورة: <strong class="text-warning">{{ $data['course_name'] }}</strong>
                </h5>
                <a href="{{ route('trainings.details', $data['id']) }}" class="btn btn-light btn-sm shadow-sm">
                    <i class="fas fa-arrow-right me-1"></i> العودة لتفاصيل الدورة
                </a>
            </div>
            
            <div class="card-body p-4">
                @if(isset($enrolled_students) && $enrolled_students->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th width="8%" class="text-center">#</th>
                                    <th width="45%" class="text-end">اسم الطالب</th>
                                    <th width="27%" class="text-center">تاريخ التسجيل</th>
                                    <th width="20%" class="text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrolled_students as $index => $enrollment)
                                    <tr>
                                        <td class="text-center font-weight-bold text-muted">{{ $index + 1 }}</td>
                                        <td class="text-end">
                                            <i class="fas fa-user-graduate text-primary me-2"></i>
                                            <span class="font-weight-bold">{{ $enrollment->student->name ?? 'غير معروف' }}</span>
                                        </td>
                                        <td class="text-center text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{-- تنسيق التاريخ ليكون مقروءاً أكثر بالعربية --}}
                                            {{ \Carbon\Carbon::parse($enrollment->enrolements_date)->format('Y/m/d') }}
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('trainings.remove_student', ['id' => $data['id'], 'student_id' => $enrollment->studentID]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm" 
                                                        title="إلغاء تسجيل هذا الطالب"
                                                        onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الطالب من الدورة؟ لا يمكن التراجع عن هذا الإجراء.')">
                                                    <i class="fas fa-user-minus me-1"></i> إلغاء التسجيل
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- ملخص سريع في أسفل الجدول --}}
                    <div class="mt-3 text-muted small text-end">
                        <i class="fas fa-info-circle me-1"></i>
                        إجمالي المسجلين في هذه الدورة: <strong>{{ $enrolled_students->count() }} طالب</strong>
                    </div>

                @else
                    {{-- حالة عدم وجود طلاب (Empty State) --}}
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-user-graduate fa-4x text-muted opacity-25"></i>
                        </div>
                        <h5 class="text-muted font-weight-bold">لا يوجد طلاب مسجلين في هذه الدورة حتى الآن</h5>
                        <p class="text-muted mb-4">يمكنك البدء بإضافة الطلاب للاستفادة من ميزات تتبع الحضور والدرجات.</p>
                        <a href="{{ route('trainings.add_student', $data['id']) }}" class="btn btn-primary shadow-sm">
                            <i class="fas fa-plus me-1"></i> إضافة طالب جديد الآن
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection