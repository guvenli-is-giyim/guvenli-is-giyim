@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Bedenler
</h2>


@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif



<a href="{{ route('admin.sizes.create') }}"
class="btn btn-primary mb-3">

Yeni Beden

</a>



<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Beden</th>
<th>Durum</th>
<th>İşlem</th>

</tr>

</thead>


<tbody>


@foreach($sizes as $size)

<tr>

<td>
{{ $size->id }}
</td>


<td>
{{ $size->name }}
</td>


<td>

@if($size->status)

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


<a href="{{ route('admin.sizes.edit',$size) }}"
class="btn btn-warning btn-sm">

Düzenle

</a>



<form action="{{ route('admin.sizes.destroy',$size) }}"
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