@extends('layouts.master')

@php
   $data= isset($edit_data) ? $edit_data : "";

   $title= $data->title ?? "";
   $image= $data->image ?? "";
   $description= $data->description ?? "";
   $id= $data->id ?? "";
@endphp
@section('admin')
<div class="row d-flex justify-content-between align-items-center py-3">

                        <div class="col-md-6">
                            <h1 class="green-100">Career Course</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-md-end">
                            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb pt-3">
                                    <li class="breadcrumb-item"><a href="#">Career Course</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                    
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a type="button" class="btn btn-primary ms-auto" href="{{ route('career_list') }}"  >Career List</a>
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
                            <form action="{{ $id ? route('career_update',$id) : route('career_store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">

                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label  class="form-label">Title <span class="text-danger">*</span> </label>  
                                        <input name="title" type="text" class="form-control" required  value="{{ $title }}">
                                        <span class="text-danger"> @error('title') {{ $message }} @enderror </span>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <label  class="form-label">Description<span class="text-danger">*</span></label>  
                                        <input name="description" type="text" class="form-control" required value="{{ $description }}" >
                                        <span class="text-danger"> @error('description') {{ $message }} @enderror </span>
                                    </div>

                                </div>

                                <div class="col-md-12 col-12 mt-3 mb-2">
                                    <label for="">Career  Image<span class="text-danger">*</span><span class="text-warning">(jpeg,png,jpg|Max:200kb)</span></label>
                                    <input type="file" id="image" name="image" class="form-control bg-light " value="" accept="image/*" {{ !$id ? "required" : "" }}>
                                    <span class="text-danger" id="image_error_show">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                    <div id="">
                                        <img id="show_image"
                                            src="{{ $image != '' ? URL::to('storage/career/' . $image) : asset('no_image.png') }}"
                                            style="width: 120px;height:120px" class="rounded img-thumbnail m-2"
                                            alt="No Image">
                                    </div>
                                </div>

                               <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-info"> {{ !$id?"Save":"Update" }} </button>
                               </div>
                              </form>
                        </div>
                    </div>
@endsection

@push('dashboard')
    <script>
                image_validation("#image", "#show_image", "#image_error_show", '200', "Image Size Can't larger than 200 KB")

    </script>
@endpush