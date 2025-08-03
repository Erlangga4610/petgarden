<h2 style="text-align: center; color: #4d7c0f;">✏️ Edit Testimoni</h2>

<form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data"
      style="text-align: center; margin-top: 20px;">
    @csrf
    @method('PUT')

    <img src="{{ asset('storage/' . $testimonial->image) }}"
         style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;"><br><br>

    <input type="file" name="image" style="padding: 8px 12px; border: 1px solid #b8e994; border-radius: 8px;"><br><br>

    <button type="submit"
        style="padding: 10px 20px; background-color: #6ab04c; color: white; border: none; border-radius: 8px; font-weight: bold;">
        Update 🌿
    </button>
</form>
