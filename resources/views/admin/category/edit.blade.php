@extends('adminlte::page')
@section('title')
Parent Category Update
@endsection

@section('content')
<div id="alert" class="alert top-0  m-3 z-index-2" style="right: 0;position: absolute;">
</div>
<br>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{route('category.update',$parent_category->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row w-100">
                            <x-adminlte-input value="{{$parent_category->name}}" id="name" name="name" label="Title"
                                placeholder="title" fgroup-class="col-md-12" />
                            <x-adminlte-input id="slug" name="slug" value='{{$parent_category->slug}}' label="Slug"
                                placeholder="slug" fgroup-class="col-md-12" />
                            <x-adminlte-input id="description" value='{{$parent_category->description}}'
                                name="description" label="Description" placeholder="description"
                                fgroup-class="col-md-12" />
                            <x-adminlte-input-file id="image" value='{{$parent_category->image}}' name="image"
                                igroup-size="" fgroup-class="col-md-12" placeholder="your image">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                        </div>

                    </form>
                    <div class="form-group">
                        <button id="submit" onclick="handleSubmit()" type="submit"
                            class="btn btn-primary">Submit</button>
                        <button onclick="history.back()" class="btn btn-danger ">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function handleSubmit(){
     let formData={
        name:$("#name").val(),
        slug:$("#slug").val(),
        description:$("#description").val(),
        image:$("#image").val(),
     };
     if(formData.name==""){
        $("#alert").removeClass("d-none");
        $("#alert").addClass("d-block");
        $("#alert").addClass("alert-danger");
        $("#alert").html("Please enter name");
     } 
     else if(formData.slug==""){
        $("#alert").removeClass("d-none");
        $("#alert").addClass("d-block");
        $("#alert").addClass("alert-danger");
        $("#alert").html("Please enter slug");
     }
     else if(formData.description==""){
        $("#alert").removeClass("d-none");
        $("#alert").addClass("d-block");
        $("#alert").addClass("alert-danger");
        $("#alert").html("Please enter description");
     }

     else{
        // sumit the form 
       $('form').submit();
        $("#submit").html("Please wait...");

     }

    //  dismiss alert after 3second
    setTimeout(function(){
        $("#alert").removeClass("d-block");
        $("#alert").addClass("d-none");
    },3000);
   }
</script>
@endsection

@section('css')
<style>
    #alert {
        z-index: 1000;
    }
</style>
@endsection