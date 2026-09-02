<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label">Kategori</label>

        <select name="category_id" class="form-control" required>

            <option value="">Kategori Seçiniz</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Marka</label>

        <select name="brand_id" class="form-control" required>

            <option value="">Marka Seçiniz</option>

            @foreach($brands as $brand)

                <option value="{{ $brand->id }}"
                    {{ old('brand_id', $product->brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>

            @endforeach

        </select>
    </div>

</div>

<div class="mb-3">

    <label class="form-label">Ürün Adı</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $product->name ?? '') }}"
        required>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">SKU</label>

        <input
            type="text"
            name="sku"
            class="form-control"
            value="{{ old('sku', $product->sku ?? '') }}"
            required>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Barkod</label>

        <input
            type="text"
            name="barcode"
            class="form-control"
            value="{{ old('barcode', $product->barcode ?? '') }}">

    </div>

</div>

<div class="mb-3">

    <label class="form-label">Kısa Açıklama</label>

    <textarea
        name="short_description"
        rows="3"
        class="form-control">{{ old('short_description', $product->short_description ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label class="form-label">Detaylı Açıklama</label>

    <textarea
        name="description"
        rows="6"
        class="form-control">{{ old('description', $product->description ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label class="form-label">Ürün Resimleri</label>

    <input
        type="file"
        name="images[]"
        class="form-control"
        multiple
        accept=".jpg,.jpeg,.png,.webp">

</div>

<div class="row">

    <div class="col-md-3">

        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                name="featured"
                value="1"
                {{ old('featured', $product->featured ?? false) ? 'checked' : '' }}>

            <label class="form-check-label">

                Öne Çıkan

            </label>

        </div>

    </div>

    <div class="col-md-3">

        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                name="status"
                value="1"
                {{ old('status', $product->status ?? true) ? 'checked' : '' }}>

            <label class="form-check-label">

                Aktif

            </label>

        </div>

    </div>

</div>

<br>