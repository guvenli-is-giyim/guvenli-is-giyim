@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Markalar
</h2>


@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif



<a href="{{ route('admin.brands.create') }}"
class="btn btn-primary mb-3">

Yeni Marka

</a>




<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>

<th>Marka Adı</th>

<th>Durum</th>

<th>İşlem</th>

</tr>

</thead>



<tbody>


@foreach($brands as $brand)

<tr>

<td>
{{ $brand->id }}
</td>


<td>
{{ $brand->name }}
</td>


<td>

@if($brand->status)

<span class="badge bg-success">
Aktif
</span>

@else

<span class="badge bg-danger">
Pasif
</span>

@endif

</td>


<td>


<a href="{{ route('admin.brands.edit',$brand) }}"
class="btn btn-warning btn-sm">

Düzenle

</a>



<form action="{{ route('admin.brands.destroy',$brand) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')


<button class="btn btn-danger btn-sm">

Sil

</button>


</form>


</td>


</tr>


@endforeach


</tbody>


</table>


</div>


@endsection