@extends('front.layouts.app')

@section('content')

<div class="container py-5">

    {{-- ========================================================= --}}
    {{-- ÜRÜN --}}
    {{-- ========================================================= --}}

    <div class="row g-5">

        {{-- ===================================================== --}}
        {{-- ÜRÜN GÖRSELİ --}}
        {{-- ===================================================== --}}

        <div class="col-lg-6">

            <div class="border rounded-4 p-4 bg-white">

                @if($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid w-100 rounded-3"
                        style="max-height:520px; object-fit:contain;"
                    >

                @else

                    <div
                        class="d-flex align-items-center justify-content-center bg-light rounded-3"
                        style="height:520px;"
                    >
                        <span class="text-muted">
                            Ürün görseli bulunmuyor
                        </span>
                    </div>

                @endif

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- ÜRÜN BİLGİLERİ --}}
        {{-- ===================================================== --}}

        <div class="col-lg-6">

            {{-- KATEGORİ --}}

            @if($product->category)

                <div class="text-muted small mb-2">
                    {{ $product->category->name }}
                </div>

            @endif


            {{-- ÜRÜN ADI --}}

            <h1 class="fw-bold mb-3">
                {{ $product->name }}
            </h1>


            {{-- MARKA --}}

            @if($product->brand)

                <div class="mb-3">

                    <span class="text-muted">
                        Marka:
                    </span>

                    <strong>
                        {{ $product->brand->name }}
                    </strong>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- VARYANT VERİLERİNİ HAZIRLA --}}
            {{-- ================================================= --}}

            @php

                $availableColors = $product->variants
                    ->filter(function ($variant) {
                        return $variant->color_id !== null
                            && $variant->color !== null;
                    })
                    ->groupBy('color_id')
                    ->map(function ($variants) {
                        return $variants->first()->color;
                    })
                    ->filter();

                $availableSizes = $product->variants
                    ->filter(function ($variant) {
                        return $variant->size_id !== null
                            && $variant->size !== null;
                    })
                    ->groupBy('size_id')
                    ->map(function ($variants) {
                        return $variants->first()->size;
                    })
                    ->filter();

                /*
                |--------------------------------------------------------------------------
                | JAVASCRIPT İÇİN VARYANT DİZİSİ
                |--------------------------------------------------------------------------
                */

                $variantData = $product->variants
                    ->values()
                    ->map(function ($variant) {
                        return [
                            'id' => $variant->id,
                            'color_id' => $variant->color_id,
                            'size_id' => $variant->size_id,
                            'stock' => (int) $variant->stock,
                            'price' => $variant->price !== null
                                ? (float) $variant->price
                                : null,
                            'sale_price' => $variant->sale_price !== null
                                ? (float) $variant->sale_price
                                : null,
                            'status' => (bool) $variant->status,
                        ];
                    })
                    ->toArray();

            @endphp


            {{-- ================================================= --}}
            {{-- FİYAT --}}
            {{-- ================================================= --}}

            <div class="mb-4">

                <span
                    id="product-price"
                    class="fs-2 fw-bold"
                >
                    {{ number_format(
                        (float) $product->price,
                        2,
                        ',',
                        '.'
                    ) }} ₺
                </span>

            </div>


            {{-- KISA AÇIKLAMA --}}

            @if($product->short_description)

                <div class="mb-4 text-muted">
                    {{ $product->short_description }}
                </div>

            @endif


            <hr>


            {{-- ================================================= --}}
            {{-- RENK --}}
            {{-- ================================================= --}}

            @if($availableColors->count() > 0)

                <div class="mb-4">

                    <label
                        for="color_id"
                        class="form-label fw-bold"
                    >
                        Renk
                    </label>

                    <select
                        id="color_id"
                        class="form-select form-select-lg"
                    >

                        <option value="">
                            Renk Seçiniz
                        </option>

                        @foreach($availableColors as $color)

                            <option value="{{ $color->id }}">
                                {{ $color->name }}
                            </option>

                        @endforeach

                    </select>

                    <div class="mt-2">

                        <span class="text-muted">
                            Seçilen renk:
                        </span>

                        <strong id="selected-color">
                            -
                        </strong>

                    </div>

                </div>

            @else

                <input
                    type="hidden"
                    id="color_id"
                    value=""
                >

                <div id="selected-color" class="d-none"></div>

            @endif


            {{-- ================================================= --}}
            {{-- BEDEN --}}
            {{-- ================================================= --}}

            @if($availableSizes->count() > 0)

                <div class="mb-4">

                    <label
                        for="size_id"
                        class="form-label fw-bold"
                    >
                        Beden
                    </label>

                    <select
                        id="size_id"
                        class="form-select form-select-lg"
                    >

                        <option value="">
                            Beden Seçiniz
                        </option>

                        @foreach($availableSizes as $size)

                            <option value="{{ $size->id }}">
                                {{ $size->name }}
                            </option>

                        @endforeach

                    </select>

                    <div class="mt-2">

                        <span class="text-muted">
                            Seçilen beden:
                        </span>

                        <strong id="selected-size">
                            -
                        </strong>

                    </div>

                </div>

            @else

                <input
                    type="hidden"
                    id="size_id"
                    value=""
                >

                <div id="selected-size" class="d-none"></div>

            @endif


            {{-- ================================================= --}}
            {{-- VARYANT MESAJI --}}
            {{-- ================================================= --}}

            <div
                id="variant-message"
                class="alert d-none"
                role="alert"
            ></div>


            {{-- ================================================= --}}
            {{-- ADET --}}
            {{-- ================================================= --}}

            <div class="mb-4">

                <label
                    for="quantity"
                    class="form-label fw-bold"
                >
                    Adet
                </label>

                <input
                    type="number"
                    id="quantity"
                    class="form-control form-control-lg"
                    value="1"
                    min="1"
                    max="1"
                    disabled
                >

            </div>


            {{-- ================================================= --}}
            {{-- SEPETE EKLE --}}
            {{-- ================================================= --}}

            <form
    action="{{ route('cart.add', $product) }}"
    method="POST"
    id="add-to-cart-form"
>

                @csrf

                <input
                    type="hidden"
                    name="product_id"
                    value="{{ $product->id }}"
                >

                <input
                    type="hidden"
                    name="variant_id"
                    id="variant_id"
                    value=""
                >

                <input
                    type="hidden"
                    name="quantity"
                    id="form_quantity"
                    value="1"
                >

                <button
                    type="submit"
                    id="add-to-cart-button"
                    class="btn btn-dark btn-lg w-100"
                    disabled
                >
                    Sepete Ekle
                </button>

            </form>


            {{-- ================================================= --}}
            {{-- STOK --}}
            {{-- ================================================= --}}

            <div
                id="stock-info"
                class="text-muted small mt-3"
            ></div>


            {{-- ================================================= --}}
            {{-- AÇIKLAMA --}}
            {{-- ================================================= --}}

            @if($product->description)

                <hr class="my-4">

                <h5 class="fw-bold mb-3">
                    Ürün Açıklaması
                </h5>

                <div class="text-muted">
                    {!! nl2br(e($product->description)) !!}
                </div>

            @endif

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- VARYANT JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENTLER
    |--------------------------------------------------------------------------
    */

    const colorSelect = document.getElementById('color_id');
    const sizeSelect = document.getElementById('size_id');

    const selectedColor = document.getElementById('selected-color');
    const selectedSize = document.getElementById('selected-size');

    const variantId = document.getElementById('variant_id');

    const quantity = document.getElementById('quantity');
    const formQuantity = document.getElementById('form_quantity');

    const addButton = document.getElementById('add-to-cart-button');

    const message = document.getElementById('variant-message');

    const stockInfo = document.getElementById('stock-info');

    const productPrice = document.getElementById('product-price');

    /*
    |--------------------------------------------------------------------------
    | VARYANT VERİLERİ
    |--------------------------------------------------------------------------
    |
    | Burada Blade içinde closure çalıştırmıyoruz.
    | PHP tarafında hazırlanmış güvenli JSON kullanıyoruz.
    |
    */

    const variants = @json($variantData);


    /*
    |--------------------------------------------------------------------------
    | ANA ÜRÜN FİYATI
    |--------------------------------------------------------------------------
    */

    const baseProductPrice = {{ (float) $product->price }};


    /*
    |--------------------------------------------------------------------------
    | FİYAT FORMATLAMA
    |--------------------------------------------------------------------------
    */

    function formatPrice(price)
    {
        return new Intl.NumberFormat(
            'tr-TR',
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        ).format(price) + ' ₺';
    }


    /*
    |--------------------------------------------------------------------------
    | MESAJ GÖSTER
    |--------------------------------------------------------------------------
    */

    function showMessage(text, type = 'danger')
    {
        message.className = 'alert alert-' + type;
        message.textContent = text;
    }


    /*
    |--------------------------------------------------------------------------
    | MESAJ GİZLE
    |--------------------------------------------------------------------------
    */

    function hideMessage()
    {
        message.className = 'alert d-none';
        message.textContent = '';
    }


    /*
    |--------------------------------------------------------------------------
    | SEÇİM METİNLERİ
    |--------------------------------------------------------------------------
    */

    function updateSelectedTexts()
    {
        if (
            colorSelect &&
            colorSelect.tagName === 'SELECT' &&
            colorSelect.value &&
            selectedColor
        ) {

            selectedColor.textContent =
                colorSelect.options[
                    colorSelect.selectedIndex
                ].text;

        } else if (selectedColor) {

            selectedColor.textContent = '-';

        }


        if (
            sizeSelect &&
            sizeSelect.tagName === 'SELECT' &&
            sizeSelect.value &&
            selectedSize
        ) {

            selectedSize.textContent =
                sizeSelect.options[
                    sizeSelect.selectedIndex
                ].text;

        } else if (selectedSize) {

            selectedSize.textContent = '-';

        }
    }


    /*
    |--------------------------------------------------------------------------
    | BAŞLANGIÇ DURUMUNA DÖN
    |--------------------------------------------------------------------------
    */

    function resetVariantState()
    {
        variantId.value = '';

        quantity.value = 1;

        quantity.min = 1;
        quantity.max = 1;
        quantity.disabled = true;

        formQuantity.value = 1;

        addButton.disabled = true;

        stockInfo.textContent = '';

        hideMessage();

        productPrice.textContent =
            formatPrice(baseProductPrice);
    }


    /*
    |--------------------------------------------------------------------------
    | VARYANT KONTROL
    |--------------------------------------------------------------------------
    */

    function updateSelection()
    {
        updateSelectedTexts();

        const colorId =
            colorSelect &&
            colorSelect.value
                ? colorSelect.value
                : null;

        const sizeId =
            sizeSelect &&
            sizeSelect.value
                ? sizeSelect.value
                : null;


        resetVariantState();


        /*
        |--------------------------------------------------------------------------
        | RENK VEYA BEDEN SEÇİMİ EKSİKSE
        |--------------------------------------------------------------------------
        */

        if (!colorId || !sizeId) {

            if (variants.length > 0) {

                showMessage(
                    'Lütfen renk ve beden seçiniz.',
                    'warning'
                );

            }

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | UYGUN VARYANTI BUL
        |--------------------------------------------------------------------------
        */

        const variant = variants.find(function (item) {

            return String(item.color_id) === String(colorId)
                &&
                String(item.size_id) === String(sizeId)
                &&
                item.status === true;

        });


        /*
        |--------------------------------------------------------------------------
        | VARYANT YOK
        |--------------------------------------------------------------------------
        */

        if (!variant) {

            showMessage(
                'Bu renk ve beden kombinasyonu mevcut değil.',
                'danger'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | STOK YOK
        |--------------------------------------------------------------------------
        */

        if (parseInt(variant.stock, 10) <= 0) {

            variantId.value = variant.id;

            stockInfo.textContent =
                'Stok: 0 adet';

            showMessage(
                'Bu renk ve beden tükenmiştir.',
                'warning'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | AKTİF VARYANT
        |--------------------------------------------------------------------------
        */

        variantId.value = variant.id;

        quantity.disabled = false;

        quantity.min = 1;

        quantity.max = parseInt(
            variant.stock,
            10
        );

        quantity.value = 1;

        formQuantity.value = 1;

        addButton.disabled = false;

        stockInfo.textContent =
            'Stok: ' +
            variant.stock +
            ' adet';


        /*
        |--------------------------------------------------------------------------
        | VARYANT FİYATI
        |--------------------------------------------------------------------------
        */

        let price =
            variant.price !== null
                ? Number(variant.price)
                : baseProductPrice;


        if (
            variant.sale_price !== null
            &&
            Number(variant.sale_price) > 0
            &&
            Number(variant.sale_price) < price
        ) {

            productPrice.innerHTML =
                '<span class="text-danger">' +
                formatPrice(Number(variant.sale_price)) +
                '</span> ' +
                '<del class="text-muted fs-5">' +
                formatPrice(price) +
                '</del>';

        } else {

            productPrice.textContent =
                formatPrice(price);

        }

    }


    /*
    |--------------------------------------------------------------------------
    | RENK DEĞİŞİKLİĞİ
    |--------------------------------------------------------------------------
    */

    if (
        colorSelect &&
        colorSelect.tagName === 'SELECT'
    ) {

        colorSelect.addEventListener(
            'change',
            updateSelection
        );

    }


    /*
    |--------------------------------------------------------------------------
    | BEDEN DEĞİŞİKLİĞİ
    |--------------------------------------------------------------------------
    */

    if (
        sizeSelect &&
        sizeSelect.tagName === 'SELECT'
    ) {

        sizeSelect.addEventListener(
            'change',
            updateSelection
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ADET DEĞİŞİKLİĞİ
    |--------------------------------------------------------------------------
    */

    quantity.addEventListener(
        'input',
        function () {

            let value =
                parseInt(
                    quantity.value,
                    10
                );


            if (
                isNaN(value)
                ||
                value < 1
            ) {

                value = 1;

            }


            const max =
                parseInt(
                    quantity.max,
                    10
                );


            if (
                max > 0
                &&
                value > max
            ) {

                value = max;

            }


            quantity.value = value;

            formQuantity.value = value;

        }
    );


    /*
    |--------------------------------------------------------------------------
    | SEPETE EKLE FORM KONTROLÜ
    |--------------------------------------------------------------------------
    */

    const addToCartForm =
        document.getElementById(
            'add-to-cart-form'
        );


    if (addToCartForm) {

        addToCartForm.addEventListener(
            'submit',
            function (event) {

                /*
                |--------------------------------------------------------------------------
                | VARYANT SEÇİLMEDİ
                |--------------------------------------------------------------------------
                */

                if (!variantId.value) {

                    event.preventDefault();

                    showMessage(
                        'Lütfen geçerli bir renk ve beden seçiniz.',
                        'danger'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | VARYANTI BUL
                |--------------------------------------------------------------------------
                */

                const selectedVariant =
                    variants.find(function (item) {

                        return String(item.id) ===
                            String(variantId.value);

                    });


                /*
                |--------------------------------------------------------------------------
                | VARYANT GEÇERSİZ
                |--------------------------------------------------------------------------
                */

                if (!selectedVariant) {

                    event.preventDefault();

                    showMessage(
                        'Seçilen varyant bulunamadı.',
                        'danger'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | STOK KONTROLÜ
                |--------------------------------------------------------------------------
                */

                if (
                    !selectedVariant.status
                    ||
                    parseInt(selectedVariant.stock, 10) <= 0
                ) {

                    event.preventDefault();

                    showMessage(
                        'Bu renk ve beden tükenmiştir.',
                        'warning'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | ADET
                |--------------------------------------------------------------------------
                */

                let selectedQuantity =
                    parseInt(
                        quantity.value,
                        10
                    );


                if (
                    isNaN(selectedQuantity)
                    ||
                    selectedQuantity < 1
                ) {

                    selectedQuantity = 1;

                }


                if (
                    selectedQuantity >
                    parseInt(
                        selectedVariant.stock,
                        10
                    )
                ) {

                    selectedQuantity =
                        parseInt(
                            selectedVariant.stock,
                            10
                        );

                }


                formQuantity.value =
                    selectedQuantity;

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | İLK DURUM
    |--------------------------------------------------------------------------
    */

    resetVariantState();

    updateSelectedTexts();

});

</script>

@endsection