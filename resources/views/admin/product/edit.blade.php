@extends('layouts.admin')

{{-- ================import css ============= --}}
@section('link_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

{{-- =============import js ==================== --}}
@section('link_js')
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="{{ asset('js/upload.js') }}"></script>
@endsection


{{-- ====================create content --}}
@section('content')
    <h1>Chỉnh Sửa Thông Tin Sản Phẩm</h1>
    {{-- {{ dd($product) }} --}}
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype='multipart/form-data'>
        @csrf
        <input type="submit" value="Xác Nhận Sửa" name="btn_add" class="btn btn-success w-25 ">
        <div class="row mt-5">
            <div class="col-xl-3">
                <div class="mb-3">
                    <label for="name" class="form-lable">Tên Sản Phẩm</label><br>
                    @error('name')
                        <span class="text-danger">( {{ $message }} )</span>
                    @enderror
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" id=name>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-lable">Giá Sản Phẩm</label><br>
                    @error('price')
                        <span class="text-danger">( {{ $message }} )</span>
                    @enderror
                    <input type="number" class="form-control" name="price" value="{{ $product->price }}"
                        placeholder=" Tiền Tệ VND" id=price>
                </div>
            </div>
            <div class="col-xl-7">
                <label for="des" class="form-lable">Mô Tả Sản Phẩm</label>
                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col">Rộng <br> @error('width')
                                    <span class="text-danger">( {{ $message }} )</span>
                                @enderror
                            </th>
                            <th scope="col">Cao <br> @error('height')
                                    <span class="text-danger">( {{ $message }} )</span>
                                @enderror
                            </th>
                            <th scope="col">Dài <br> @error('long')
                                    <span class="text-danger">( {{ $message }} )</span>
                                @enderror
                            </th>
                            <th scope="col">Chất Liệu <br>
                                @error('material')
                                    <span class="text-danger">( {{ $message }} )</span>
                                @enderror
                            </th>
                            <th scope="col">Số Lượng <br>
                                @error('amount')
                                    <span class="text-danger">( {{ $message }} )</span>
                                @enderror
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-control" min="0" placeholder=" cm" value="{{ $product->width }}"
                                    type="number" name="width" id="width">
                            </td>
                            <td><input class="form-control" min="0" placeholder=" cm" value="{{ $product->height }}"
                                    type="number" name="height" id="height"></td>
                            <td><input class="form-control" min="0" placeholder=" cm" value="{{ $product->long }}"
                                    type="number" name="long" id="long">
                            </td>
                            <td><input class="form-control" type="text" value="{{ $product->material }}" name="material"
                                    id="material"></td>
                            <td><input class="form-control" min="1" type="number" name="amount"
                                    value="{{ $product->amount }}" id="amount"></td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-2">
                <label for="cat">Sản Phẩm</label><br>
                @error('category')
                    <span class="text-danger">( {{ $message }} )</span>
                @enderror
                <select class="form-select" id="category">
                    <option value="">Chọn Giá Trị </option>
                    @foreach ($cat as $item)
                        <option {{$parent_id->parent_id == $item->id?'selected' : ''}} value="{{$item->id}}">{{$item->name}} </option>
                    @endforeach
                </select>

                <label for="sub_cat">Loại Sản Phẩm</label><br>
                @error('category')
                    <span class="text-danger">( {{ $message }} )</span>
                @enderror
                <select name="category"  class="form-select" id="sub_cat">
                    <option class="op_cat" value="{{$parent_id->id}}">{{$parent_id->name}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7">
                <label for="des" class="form-lable">Chi Tiết Sản Phẩm</label>
                @error('description')
                    <span class="text-danger">( {{ $message }} )</span>
                @enderror
                <textarea name="description" class="form-control" id="des" cols="30"
                    rows="20">{{ $product->description }}</textarea>
            </div>
            <div style="min-height: 450px" class="col-xl-5 border mt-4">
                <h5 class="text-center"> Chọn Ảnh Đại Diện</h5>
                @error('path_img_thumb')
                    <span class="text-danger">( {{ $message }} )</span>
                @enderror
                <input type='file' id="file" name='img' class="form-control">
                <div class=" text-center displaynone" id="responseMsg"></div>
                <div id="result" style="min-height: 300px" class="mt-3 text-center">
                    <img src="{{ url($product->thumnail) }}" id="thumb_old" style=" width:300px;height:300px; " alt="">
                    <div id="img_show">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-5 ">
            <h4> Các Ảnh Mô Tả Khác</h4><span class=" alert" id="mess_muti"></span>
            <form id="multiple-image-preview-ajax" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="images[]" id="images" placeholder="Choose images" multiple>
                        </div>
                        @error('images')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="mt-1 text-center">
                            <div class="show-multiple-image-preview d-flex" style="min-height: 300px">
                                @foreach ($img as $item)
                                    <img src="{{url($item->path)}}"  class="img-fluid w-25 img_old" alt="">
                                    <input type="hidden" value="{{$item->path}}" name="path_unlink[]">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        {{-- <button type="submit" class="btn btn-primary" id="submit">Đăng Ảnh</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </form>
@endsection
