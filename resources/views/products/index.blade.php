<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoPet - Grow a Garden</title>
    <style>
        body {
            background: #e9f5e1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            top: 0;
            bottom: 0;
            width: 60px;
            background: linear-gradient(to bottom, #d8f3dc, #b7e4c7, #95d5b2);
            z-index: -1;
        }

        body::before {
            left: 0;
            border-top-right-radius: 40px;
            border-bottom-right-radius: 40px;
            box-shadow: inset -10px 0 15px rgba(0, 0, 0, 0.05);
        }

        body::after {
            right: 0;
            border-top-left-radius: 40px;
            border-bottom-left-radius: 40px;
            box-shadow: inset 10px 0 15px rgba(0, 0, 0, 0.05);
        }

        .leaf {
            position: fixed;
            width: 80px;
            opacity: 0.8;
            animation: sway 4s ease-in-out infinite alternate;
            z-index: 0;
        }

        .leaf.top {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .leaf.bottom {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) rotate(180deg);
        }

        @keyframes sway {
            0% { transform: translateX(-50%) rotate(0deg); }
            100% { transform: translateX(-50%) rotate(5deg); }
        }

        h1 {
            text-align: center;
            color: #4d7c0f;
            margin-bottom: 20px;
        }

        .top-action {
            text-align: center;
            margin-bottom: 30px;
        }

        .top-action a {
            background-color: #6ab04c;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .top-action a:hover {
            background-color: #60a844;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .produk {
            background: #ffffff;
            border: 2px solid #b8e994;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 15px;
            width: 220px;
            text-align: center;
            transition: transform 0.2s;
        }

        .produk:hover {
            transform: scale(1.05);
        }

        .produk img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .produk h3 {
            color: #2d6a4f;
            font-size: 18px;
            margin: 10px 0 5px;
        }

        .produk p {
            margin: 5px 0;
            color: #4f772d;
        }

        .produk a button {
            background-color: #95d5b2;
            color: #1b4332;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        .produk a button:hover {
            background-color: #74c69d;
        }

        .crud-buttons {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .crud-buttons a, .crud-buttons form button {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .crud-buttons a {
            background-color: #ffe066;
            color: #7f5f00;
        }

        .crud-buttons a:hover {
            background-color: #ffdd57;
        }

        .crud-buttons form button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            cursor: pointer;
        }

        .crud-buttons form button:hover {
            background-color: #e63946;
        }

        .auth-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .auth-buttons form button,
        .auth-buttons a {
            background-color: #b5ead7;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            color: #1b4332;
            text-decoration: none;
            margin: 5px;
        }

        .auth-buttons form button:hover,
        .auth-buttons a:hover {
            background-color: #95d5b2;
        }

        @media (max-width: 600px) {
        .container {
            flex-direction: column;
            align-items: center;
        }

        .produk {
            width: 90%;
        }

        .search-bar form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }

        .search-bar input,
        .search-bar button {
            width: 90%;
        }

        .top-action {
            display: flex;
            justify-content: center;
        }
    }

    </style>
</head>
<body>

    <!-- Gambar daun atas & bawah -->
    {{-- <img src="https://i.ibb.co/vD2sqFv/daun-1.png" class="leaf top" alt="daun atas">
    <img src="https://i.ibb.co/vD2sqFv/daun-1.png" class="leaf bottom" alt="daun bawah"> --}}

    <h1>🌱 Pet Grow A Garden</h1>
    <!-- Form Search -->
    <div class="search-bar" style="text-align: center; margin-bottom: 20px;">
    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari nama produk..." value="{{ request('search') }}"
            style="padding: 8px 12px; border-radius: 8px; border: 1px solid #b8e994; width: 250px;">
        <button type="submit" style="padding: 8px 12px; border: none; background-color: #6ab04c; color: white; border-radius: 8px;">Cari</button>
    </form>
    </div>


    @if(Auth::check())
        <div class="top-action">
            <a href="{{ route('products.create') }}">➕ Tambah Produk</a>
        </div>
    @endif

    <div class="container">
        @foreach ($products as $produk)
            <div class="produk">
                <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->name }}">
                <h3>{{ $produk->name }}</h3>
                <p>Stok: {{ $produk->stock }}</p>
                <p>Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>

                <a href="https://wa.me/6283139779302?text={{ urlencode('Hai Saya Akan Beli "' . $produk->name . '" (Stok: ' . $produk->stock . ', Harga: Rp' . number_format($produk->harga, 0, ',', '.') . ')') }}" target="_blank">
                    <button>🌼 Pesan via WhatsApp</button>
                </a>

                @auth
                    <div class="crud-buttons">
                        <a href="{{ route('products.edit', $produk->id) }}">✏️ Edit</a>
                        <form action="{{ route('products.destroy', $produk->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus produk ini?')">🗑️ Hapus</button>
                        </form>
                    </div>
                @endauth
            </div>
        @endforeach
    </div>

    <div class="auth-buttons">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">🔐 Login Owner</a>
        @endauth

        {{-- Tombol ke halaman testimoni --}}
        <a href="{{ route('testimonials.index') }}">📷 Lihat Testimoni</a>
    </div>


    <script>
    const searchInput = document.querySelector('input[name="search"]');

    searchInput.addEventListener('input', function () {
        if (this.value === '') {
            window.location.href = '{{ route("products.index") }}';
        }
    });
</script>

<script>
    const searchInput = document.querySelector('input[name="search"]');
    const container = document.querySelector('.container');

    searchInput.addEventListener('input', function () {
        fetch(`?search=${this.value}`)
            .then(res => res.json())
            .then(data => {
                container.innerHTML = data.html;
            });
    });
</script>


</body>
</html>
