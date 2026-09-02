@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Yeni Marka Ekle
</h2>



@if($errors->any())

<div class="alert alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif




<form action="{{ route('admin.brands.store') }}"
method="POST">

@csrf



<div class="mb-3">

<label class="form-label">
Marka Adı
</label>


<input type="text"
name="name"
class="form-control"
value="{{ old('name') }}">


</div>




<div class="form-check mb-3">


<input type="checkbox"
name="status"
class="form-check-input"
checked>


<label class="form-check-label">

Aktif

</label>


</div>




<button class="btn btn-success">

Kaydet

</button>



<a href="{{ route('admin.brands.index') }}"
class="btn btn-secondary">

Geri

</a>



</form>


</div>


@endsection