@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Marka Düzenle
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




<form action="{{ route('admin.brands.update',$brand) }}"
method="POST">

@csrf
@method('PUT')




<div class="mb-3">

<label class="form-label">
Marka Adı
</label>


<input type="text"
name="name"
class="form-control"
value="{{ $brand->name }}">


</div>





<div class="form-check mb-3">


<input type="checkbox"
name="status"
class="form-check-input"
{{ $brand->status ? 'checked' : '' }}>


<label class="form-check-label">

Aktif

</label>


</div>




<button class="btn btn-warning">

Güncelle

</button>



<a href="{{ route('admin.brands.index') }}"
class="btn btn-secondary">

Geri

</a>



</form>


</div>


@endsection