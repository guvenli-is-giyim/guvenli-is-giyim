@extends('admin.layouts.app')

@section('content')

<div class="container">


<h2 class="mb-4">
Beden Düzenle
</h2>



<form action="{{ route('admin.sizes.update',$size) }}"
method="POST">

@csrf
@method('PUT')



<div class="mb-3">

<label>
Beden
</label>


<input type="text"
name="name"
class="form-control"
value="{{ $size->name }}">


</div>




<div class="form-check mb-3">


<input type="checkbox"
name="status"
{{ $size->status ? 'checked':'' }}>


<label>

Aktif

</label>


</div>




<button class="btn btn-warning">

Güncelle

</button>


<a href="{{ route('admin.sizes.index') }}"
class="btn btn-secondary">

Geri

</a>


</form>


</div>


@endsection