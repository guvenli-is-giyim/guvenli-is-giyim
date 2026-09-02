@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Kategoriler
    </h2>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    <a href="{{ route('admin.categories.create') }}"
       class="btn btn-primary mb-3">

        Yeni Kategori

    </a>


    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>

                <th>Kategori</th>

                <th>Durum</th>

                <th>İşlem</th>

            </tr>

        </thead>


        <tbody>

            @forelse($categories as $category)

                <tr>

                    <td>
                        {{ $category->id }}
                    </td>


                    <td>
                        {{ $category->name }}
                    </td>


                    <td>

                        @if($category->status)

                            <span class="badge bg-success">
                                Aktif
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Pasif
                            </span>

                        @endif

                    </td>


                    <td>

                        <a
                            href="{{ route('admin.categories.edit',$category) }}"
                            class="btn btn-sm btn-warning"
                        >

                            Düzenle

                        </a>


                        <form
                            action="{{ route('admin.categories.destroy',$category) }}"
                            method="POST"
                            style="display:inline"
                            onsubmit="return confirm('Bu kategoriyi silmek istediğinizden emin misiniz?');"
                        >

                            @csrf

                            @method('DELETE')


                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                            >

                                Sil

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="4"
                        class="text-center"
                    >

                        Henüz kategori bulunmuyor.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection