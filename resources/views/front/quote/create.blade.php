@extends('front.layouts.app')

@section('title','Teklif Al')

@section('content')


<section class="py-5 bg-light">

<div class="container">


<div class="row justify-content-center">


<div class="col-lg-7">


<div class="card shadow">


<div class="card-body p-4">


<h2 class="mb-4">

Kurumsal Teklif Formu

</h2>



@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif




@if($product)

<div class="alert alert-warning">

<strong>Seçilen Ürün:</strong>

{{ $product->name }}

</div>

@endif





<form action="{{ route('quote.store') }}"
method="POST">


@csrf




<div class="mb-3">

<label>
Ad Soyad / Firma
</label>


<input type="text"
name="name"
class="form-control"
required>

</div>





<div class="mb-3">

<label>
Telefon
</label>


<input type="text"
name="phone"
class="form-control"
required>

</div>





<div class="mb-3">

<label>
E-posta
</label>


<input type="email"
name="email"
class="form-control">

</div>





<div class="mb-3">

<label>
Mesaj
</label>


<textarea name="message"
class="form-control"
rows="5">@if($product)
Ürün: {{ $product->name }}
@endif</textarea>


</div>





<button class="btn btn-warning btn-lg">

Teklif Gönder

</button>


</form>



</div>


</div>


</div>


</div>


</div>


</section>


@endsection