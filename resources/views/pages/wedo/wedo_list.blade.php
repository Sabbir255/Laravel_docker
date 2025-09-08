@extends('layouts.master')


@section('admin')
    <div class="row d-flex justify-content-between align-items-center py-3">

        <div class="col-md-6">
            <h1 class="green-100">What we do</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-md-end">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb pt-3">
                    <li class="breadcrumb-item"><a href="#">What we do</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-table me-1"></i> List </span>
            <a href="{{ route('wedo_create') }}" type="button" class="btn btn-primary ms-auto">Add new we do</a>
        </div>

        <div class="card-body">

            @if (Session::has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($wedo as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ $item->image != '' ? URL::to('storage/wedo/' . $item->image) : asset('no_image.png') }}"
                                    style="width: 80px;height:80px" class="rounded img-thumbnail m-2" alt="No Image">
                            </td>
                            <td>{{ $item->title ?? '' }}</td>
                            <td>{{ $item->description ?? '' }}</td>
                            <td>
                                <a href="{{ route('wedo_edit',$item->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('wedo_delete',$item->id) }}" class="btn btn-danger delete_data">X</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
@endsection
