@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Kategori Düzenle
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



<form action="{{ route('admin.categories.update',$category) }}"
method="POST">

@csrf
@method('PUT')



<div class="mb-3">

<label class="form-label">
Kategori Adı
</label>


<input type="text"
name="name"
class="form-control"
value="{{ $category->name }}">


</div>



<div class="mb-3">

<label class="form-label">
Açıklama
</label>


<textarea name="description"
class="form-control"
rows="4">{{ $category->description }}</textarea>


</div>




<div class="form-check mb-3">

<input type="checkbox"
name="status"
class="form-check-input"
{{ $category->status ? 'checked' : '' }}>


<label class="form-check-label">
Aktif
</label>


</div>




<button class="btn btn-warning">

Güncelle

</button>



<a href="{{ route('admin.categories.index') }}"
class="btn btn-secondary">

Geri

</a>


</form>


</div>

@endsection