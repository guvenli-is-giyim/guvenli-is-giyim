@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Renkler
</h2>


@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif



<a href="{{ route('admin.colors.create') }}"
class="btn btn-primary mb-3">

Yeni Renk

</a>



<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Renk</th>
<th>Kod</th>
<th>Durum</th>
<th>İşlem</th>

</tr>

</thead>


<tbody>


@foreach($colors as $color)

<tr>

<td>
{{ $color->id }}
</td>


<td>
{{ $color->name }}
</td>


<td>
{{ $color->code }}
</td>


<td>

@if($color->status)

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

<a href="{{ route('admin.colors.edit',$color) }}"
class="btn btn-warning btn-sm">

Düzenle

</a>


<form action="{{ route('admin.colors.destroy',$color) }}"
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