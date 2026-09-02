@extends('admin.layouts.app')

@section('content')

<div class="container">


<h2 class="mb-4">
Renk Düzenle
</h2>



<form action="{{ route('admin.colors.update',$color) }}"
method="POST">

@csrf
@method('PUT')



<div class="mb-3">

<label>
Renk Adı
</label>


<input type="text"
name="name"
class="form-control"
value="{{ $color->name }}">


</div>




<div class="mb-3">

<label>
Renk Kodu
</label>


<input type="text"
name="code"
class="form-control"
value="{{ $color->code }}">


</div>




<div class="form-check mb-3">


<input type="checkbox"
name="status"
{{ $color->status ? 'checked':'' }}>


<label>

Aktif

</label>


</div>



<button class="btn btn-warning">

Güncelle

</button>


<a href="{{ route('admin.colors.index') }}"
class="btn btn-secondary">

Geri

</a>


</form>


</div>


@endsection