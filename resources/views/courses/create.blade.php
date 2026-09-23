@extends('admin.layouts.master')
@section('title')
    اضافة كورس
@endsection
@section('content')
<div class="col md 12">
  <!-- form start -->
              <form role="form" method="POST" action="{{ route('courses.store') }}" style="width:80%;margin:0 auto;background-color:white;">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">اسم الكورس</label>
                    <input autofocus type="text" class="form-control" id="name" placeholder="ادخل اسم الكورس" value="{{ old('name') }}">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="link">الرابط</label>
                    <input type="text" class="form-control" id="link" placeholder="ادخل رابط الكورس" value="{{ old('link') }}">
                   @error('link')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror  
                </div>
                   <div class="form-group">
                    <label for="status">الحالة</label>
                    <select name="active" id="active" class="form-control">
                        <option value="">اختر الحالة</option>
                        <option value="1">مفعل</option>
                        <option value="0">غير مفعل</option>
                        
                    </select>
                       @error('active')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" style="text-align: center;">
 <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
              </div>
@endsection