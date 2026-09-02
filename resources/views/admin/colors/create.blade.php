@extends('admin.layouts.app')

@section('content')

<div class="container">


<h2 class="mb-4">
Yeni Renk Ekle
</h2>



<form action="{{ route('admin.colors.store') }}"
method="POST">

@csrf



<div class="mb-3">

<label>
Renk Adı
</label>

<input type="text"
name="name"
class="form-control">

</div>



<div class="mb-3">

<label>
Renk Kodu
</label>

<input type="text"
name="code"
class="form-control"
placeholder="#000000">

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


<a href="{{ route('admin.colors.index') }}"
class="btn btn-secondary">

Geri

</a>


</form>


</div>

@endsection