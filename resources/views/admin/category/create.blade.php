@extends('adminlte::page')
@section('title')
Parent Category Create
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
                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row w-100">
                            <x-adminlte-input value="{{old('name')}}" id="name" name="name" label="Title" placeholder="title"
                                fgroup-class="col-md-12" />
                            <x-adminlte-input id="slug" name="slug" label="Slug" placeholder="slug"
                                fgroup-class="col-md-6" />
                            <x-adminlte-select value="{{old('parent_id')}}" id="parent_id" name="parent_id" label='Select Parent' fgroup-class="col-md-6">
                                {{-- {{dd($parent_categories)}} --}}
                                @foreach ($parent_categories as $key => $parent_category)
                                <option value="{{$key}}">{{$parent_category}}</option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-input value="{{old('description')}}" id="description" name="description" label="Description"
                                placeholder="description" fgroup-class="col-md-12" />
                            <x-adminlte-input-file value="{{old('image')}}" id="image" name="image" igroup-size="" fgroup-class="col-md-12"
                                placeholder="your image">
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
        parent_id:$("#parent_id").val(),
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
     else if(formData.image==""){
        $("#alert").removeClass("d-none");
        $("#alert").addClass("d-block");
        $("#alert").addClass("alert-danger");
        $("#alert").html("Please choose image");
     }
     else if(formData.parent_id==""){
        $("#alert").removeClass("d-none");
        $("#alert").addClass("d-block");
        $("#alert").addClass("alert-danger");
        $("#alert").html("Please choose parent category");
     }

     else{
        // sumit the form 
       $('form').submit();
        $("#submit").html("Please wait...");

        // send ajax request
        // $.ajax({
        //   type: "POST",
        //   url: "/parent-category/store",
        //   data: formData,
        //   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //   dataType: "json",
        //   success: function (data) {
        //       $("#alert").removeClass("d-none");
        //   $("#alert").addClass("d-block");
        //   $("#alert").addClass("alert-sucess");
        //   $("#alert").html(data.message);
        //     } 
        //   ,
        //   error: function (data) {
        //       $("#alert").removeClass("d-none");
        //   $("#alert").addClass("d-block");
        //   $("#alert").addClass("alert-danger");
        //   $("#alert").html('Something went wrong');
        //   },
        // });
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