<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - TokoPet</title>
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
            background-color: #6ab04c;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #60a844;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
            color: #4d7c0f;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>🌱 Tambah Produk</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" placeholder="Nama Produk" required>

            <input type="number" name="stock" placeholder="Stok" required>

            <input type="number" name="harga" placeholder="Harga (Rp)" required>

            <input type="file" name="image" required>

            <button type="submit">📦 Simpan Produk</button>
        </form>

        <a class="back-link" href="{{ route('products.index') }}">← Kembali ke daftar produk</a>
    </div>

</body>
</html>
