@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">
Yeni Banner Ekle
</h2>


<form action="{{ route('admin.banners.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf


<div class="mb-3">

<label>
Başlık
</label>

<input type="text"
name="title"
class="form-control"
required>

</div>



<div class="mb-3">

<label>
Açıklama
</label>

<textarea name="description"
class="form-control"
rows="4"></textarea>

</div>



<div class="mb-3">

<label>
Görsel
</label>

<input type="file"
name="image"
class="form-control"
required>

</div>




<div class="mb-3">

<label>
Buton Yazısı
</label>

<input type="text"
name="button_text"
class="form-control"
placeholder="Teklif Al">

</div>




<div class="mb-3">

<label>
Buton Linki
</label>

<input type="text"
name="button_link"
class="form-control"
placeholder="/teklif-al">

</div>




<div class="mb-3">

<label>
Sıra
</label>

<input type="number"
name="sort_order"
class="form-control"
value="0">

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


<a href="{{ route('admin.banners.index') }}"
class="btn btn-secondary">

Geri

</a>



</form>


</div>

@endsection