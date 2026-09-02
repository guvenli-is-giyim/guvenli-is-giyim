@extends('admin.layouts.app')

@section('content')

<div class="container">


<h2 class="mb-4">
Yeni Beden Ekle
</h2>



<form action="{{ route('admin.sizes.store') }}"
method="POST">

@csrf



<div class="mb-3">

<label>
Beden
</label>


<input type="text"
name="name"
class="form-control"
placeholder="Örn: S, M, L, XL, 42">


</div>




<div class="form-check mb-3">


<input type="checkbox"
name="status"
checked>


<label>

Aktif

</label>


</div>




<button class="btn btn-success">

Kaydet

</button>


<a href="{{ route('admin.sizes.index') }}"
class="btn btn-secondary">

Geri

</a>


</form>


</div>


@endsection