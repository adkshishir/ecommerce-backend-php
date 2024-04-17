@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content')
@isset($status)
@if($status == 'success')
<div class="alert alert-success" role="alert">
    {{ $message }}
</div>
@else
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@endif
@endisset
<div class="p-2">
    @php
    $heads = [
    'ID',
    'Name',
    ['label' => 'Description', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];
    $getInButton=function($type,$parent_category){
    if($type=='delete'){
    return '<form action="'.route('category.destroy',$parent_category->id).'" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="'.csrf_token().'">
        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>
    </form>';
    }else if($type=='edit'){
    return
    '<a href="'.route('parent-category.edit',$parent_category->id).'"
        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </a>';
    };
    };

    $data = [];
    foreach ($categories as $key=>$parent_category) {
    $data[]=[
    $parent_category->id,
    $parent_category->name,
    $parent_category->description,
    '<nobr class="d-flex justify-content-center">
        '.$getInButton('edit',$parent_category).$getInButton('delete',$parent_category).$getInButton('details',$parent_category).'
    </nobr>'
    ];
    }

    $config = [
    'data' => $data,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
    ];

    @endphp
    <div class="container  rounded p-2 bg-white">
        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
            <tr>
                @foreach($row as $cell)
                <td>{!! $cell !!}</td>
                @endforeach
            </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>



</div>




@endsection

@push('js')
<script>
    //  

</script>
@endpush