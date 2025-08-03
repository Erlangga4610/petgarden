<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - TokoPet</title>
    <style>
        body {
            background-color: #e9f5e1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
            margin: 0;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: #ffffff;
            border: 2px solid #b8e994;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #4d7c0f;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 15px;
            border: 1px solid #b8e994;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f6c90e;
            color: #333;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #e0b70c;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
            color: #4d7c0f;
            font-weight: bold;
        }

        .preview-img {
            display: block;
            margin: 0 auto 15px;
            max-width: 150px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>✏️ Edit Produk</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $product->name }}" placeholder="Nama Produk" required>

            <input type="number" name="stock" value="{{ $product->stock }}" placeholder="Stok" required>

            <input type="number" name="harga" value="{{ $product->harga }}" placeholder="Harga (Rp)" required>

            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="preview-img">
            @endif

            <input type="file" name="image">

            <button type="submit">💾 Simpan Perubahan</button>
        </form>

        <a class="back-link" href="{{ route('products.index') }}">← Kembali ke daftar produk</a>
    </div>

</body>
</html>
