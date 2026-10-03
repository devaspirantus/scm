                <table class="table table-bordered table-hover" id="example2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th>الدولة</th>
                            <th>رقم الهوية</th>
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
                                <td>{{ $info->nationalID ?? 'غير متوفر' }}</td>
                                {{-- ✅ إضافة ?? للحماية من القيم الفارغة (Null) --}}
                                <td>{{ $info->address ?? 'غير متوفر' }}</td>
                                <td>{{ $info->phone ?? 'غير متوفر' }}</td>
                                <td>@php
                                    $imagePath = $info->image ? 'uploads/' . $info->image : 'uploads/avatar.png';
                                    $fullPath = public_path($imagePath);
                                    $finalImage = file_exists($fullPath)
                                        ? asset($imagePath)
                                        : asset('uploads/avatar.png');
                                @endphp
                                    <img src="{{ $finalImage }}" class="rounded-circle" alt="logo"
                                        style="height:40px;width:40px;">
                                </td>
                                <td>{{ $info->notes ?? '-' }}</td>

                                <td>
                                    @if ($info->active == 1)
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
                                        <a href="{{ route('students.edit', $info->id) }}" class="btn btn-sm btn-warning"
                                            title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- ✅ تم تصحيح المسار والنص إلى students.destroy وحذف الطالب --}}
                                        <form action="{{ route('students.destroy', $info->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="حذف"
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