@extends('admin.layouts.app')

@section('content')


<div class="container">


<h2 class="mb-4">

Teklif Talepleri

</h2>



@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif




<table class="table table-bordered">


<thead>

<tr>

<th>
Ad
</th>

<th>
Telefon
</th>

<th>
E-posta
</th>

<th>
Mesaj
</th>

<th>
Durum
</th>

<th>
İşlem
</th>

</tr>

</thead>




<tbody>


@foreach($quoteRequests as $quote)


<tr>


<td>

{{ $quote->name }}

</td>


<td>

{{ $quote->phone }}

</td>


<td>

{{ $quote->email }}

</td>


<td>

{{ $quote->message }}

</td>



<td>


<form action="{{ route('admin.quote-requests.update',$quote) }}"
method="POST">


@csrf
@method('PUT')



<select name="status"
class="form-control"
onchange="this.form.submit()">



<option value="Bekliyor"
{{ $quote->status=='Bekliyor'?'selected':'' }}>

Bekliyor

</option>



<option value="İletişim Kuruldu"
{{ $quote->status=='İletişim Kuruldu'?'selected':'' }}>

İletişim Kuruldu

</option>



<option value="Tamamlandı"
{{ $quote->status=='Tamamlandı'?'selected':'' }}>

Tamamlandı

</option>



</select>


</form>


</td>



<td>


<form action="{{ route('admin.quote-requests.destroy',$quote) }}"
method="POST">


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