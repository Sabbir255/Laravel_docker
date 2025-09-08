@extends('layouts.master')


@section('admin')
    <div class="row d-flex justify-content-between align-items-center py-3">

        <div class="col-md-6">
            <h1 class="green-100">Banner</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-md-end">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb pt-3">
                    <li class="breadcrumb-item"><a href="#">Banner</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-table me-1"></i> List </span>
            <a href="{{ route('banner_create') }}" type="button" class="btn btn-primary ms-auto">Add new banner</a>
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
                        <th class="align-middle text-nowrap">Sl.</th>
                        <th class="align-middle text-nowrap">Image</th>
                        <th class="align-middle text-nowrap">Title</th>
                        <th class="align-middle text-nowrap">Title(bn)</th>
                        <th class="align-middle text-nowrap">Description</th>
                        <th class="align-middle text-nowrap">Description(bn)</th>
                        <th class="align-middle text-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($banner_list as $key => $item)
                        <tr>
                            <td class="align-middle text-nowrap">{{ $key + 1 }}</td>
                            <td class="align-middle text-nowrap">
                                <img src="{{ $item->image != '' ? URL::to('storage/banner/' . $item->image) : asset('no_image.png') }}"
                                    style="width: 80px;height:80px" class="rounded img-thumbnail m-2" alt="No Image">
                            </td>
                            <td class="align-middle text-nowrap">{{ $item->title ?? '' }}</td>
                            <td class="align-middle text-nowrap">{{ $item->title_bn ?? '' }}</td>
                            <td>{{ $item->description ?? '' }}</td>
                            <td>{{ $item->description_bn ?? '' }}</td>
                            <td class="align-middle text-nowrap">
                                <a href="{{ route('banner_edit',$item->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('banner_delete',$item->id) }}" class="btn btn-danger delete_data">X</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
@endsection
