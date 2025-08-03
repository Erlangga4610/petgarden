<h2 style="text-align: center; color: #4d7c0f; margin-bottom: 20px;">🌼 Galeri Testimoni 🌼</h2>

<div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-bottom: 40px;">
    @foreach ($testimonials as $t)
        <div style="
            background: #ffffff;
            border: 2px solid #b8e994;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 10px;
            width: 180px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        ">
            <img src="{{ asset('storage/' . $t->image) }}"
                 alt="testimoni"
                 class="testimoni-img"
                 style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; cursor: pointer;">

            @auth
                <div style="margin-top: 10px; text-align: center;">
                    <a href="{{ route('testimonials.edit', $t->id) }}"
                       style="font-size: 12px; padding: 6px 12px; background-color: #ffe066; border-radius: 6px; text-decoration: none; color: #7f5f00;">
                       ✏️ Edit
                    </a>
                    <form action="{{ route('testimonials.destroy', $t->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" 
                                style="font-size: 12px; padding: 6px 12px; background-color: #ff6b6b; border: none; border-radius: 6px; color: white; cursor: pointer;">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    @endforeach
</div>

@auth
<h3 style="text-align: center; color: #4d7c0f;">➕ Upload Testimoni Gambar</h3>
<form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data"
      style="text-align: center; margin-top: 20px;">
    @csrf
    <input type="file" name="image" required
        style="padding: 8px 12px; border: 1px solid #b8e994; border-radius: 8px;"><br><br>
    <button type="submit"
        style="padding: 10px 20px; background-color: #6ab04c; color: white; border: none; border-radius: 8px; font-weight: bold;">
        Upload 🌿
    </button>
</form>
@endauth

<div style="text-align: center; margin-top: 20px;">
    <a href="{{ route('products.index') }}"
       style="padding: 10px 20px; background-color: #95d5b2; color: #1b4332; border-radius: 8px; text-decoration: none; font-weight: bold;">
        🌿 Lihat Pet
    </a>
</div>


{{-- Lightbox Modal --}}
<div id="lightbox" style="
    display: none;
    position: fixed;
    z-index: 999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.8);
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.3s ease-in-out;
">
    <div style="position: relative;">
        <img id="lightbox-img" src="" style="
            max-width: 90vw;
            max-height: 90vh;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        ">
        <button id="lightbox-close" style="
            position: absolute;
            top: -10px;
            right: -10px;
            background: #fff;
            color: #333;
            border: none;
            border-radius: 50%;
            font-size: 18px;
            width: 30px;
            height: 30px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        ">✖</button>
    </div>
</div>

{{-- Lightbox Script --}}
<style>
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const closeBtn = document.getElementById('lightbox-close');

        document.querySelectorAll('.testimoni-img').forEach(img => {
            img.addEventListener('click', () => {
                lightbox.style.display = 'flex';
                lightboxImg.src = img.src;
                lightboxImg.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    lightboxImg.style.transform = 'scale(1)';
                }, 100);
            });
        });

        closeBtn.addEventListener('click', () => {
            lightbox.style.display = 'none';
        });

        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.style.display = 'none';
            }
        });
    });
</script>
