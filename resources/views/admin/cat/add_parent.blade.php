@extends('layouts.admin')


{{-- ================import css ============= --}}
@section('link_css')

@endsection

{{-- =============import js ==================== --}}
@section('link_js')

@endsection


{{-- ====================create content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 bg-b">
                <h1>Thêm Danh Mục Cha</h1>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    <h4> {{ session('status') }}</h4>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-5 p-5 mt-4 bg-b_2">
                <form action="{{ route('cat.create_parent') }}" method="post">
                    @csrf
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Tên Danh Mục Cha') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="">
                        <input type="submit" value=" Thêm Danh Mục" class="btn mt-5 btn-success">
                        <a href="{{ route('cat.add_children') }}" class="btn mt-5  btn-primary">Thêm Danh Mục Con</a>
                    </div>
                </form>
                <h4 class="mt-5 text-center">Danh Sách Danh Mục Cha</h4>
                <table class="table border text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID Danh Mục Cha</th>
                            <th scope="col">Tên Danh Mục Cha</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-xl-1"></div>
            <div class="col-xl-6 bg-b p-5 mt-4">
                <h4 class="text-center">Danh Sách Danh Mục Con</h4>
                <table class="table border text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID Danh Mục Con</th>
                            <th scope="col">Tên Danh Mục Con</th>
                            <th scope="col">ID Danh Mục Cha</th>
                            <th scope="col">Tên Danh Mục Cha</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_cat as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->parent_id }}</td>
                                <td>
                                    @foreach ($cat as $i)
                                        {{ $item->parent_id == $i->id ? "{$i->name}" : '' }}
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
