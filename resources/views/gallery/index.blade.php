@extends('layouts.main')

@section('content')
    <section class="counts section-bg">
        <div class="section-title">
            <h2>Galeri</h2>
        </div>
        <div class="container">
            <div class="row-gallery">
                @foreach ($galerrys as $gallery)
                    <div class="image-card col-lg-3">
                        <picture>
                            <img src="{{ asset('storage/' . $gallery->gambar) }}" class="img-fluid gallery-img"
                                alt="Gallery" style="width: 300px; height: 200px; object-fit: cover;">
                            <p class="text-gallery">{{ $gallery->keterangan }}</p>
                        </picture>
                    </div>
                @endforeach
            </div>
            <div class="paginate my-3" style="text-align: center">
                {{ $galerrys->links() }}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".gallery-img");
    const modal = document.createElement("div");
    modal.id = "imageModal";
    modal.style.display = "none";
    modal.style.position = "fixed";
    modal.style.top = "0";
    modal.style.left = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.backgroundColor = "rgba(0,0,0,0.8)";
    modal.style.justifyContent = "center";
    modal.style.alignItems = "center";
    modal.style.zIndex = "1000";
    modal.innerHTML = `
        <div style="position: relative; max-width: 90%; max-height: 90%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <span id="closeModal" style="position: absolute; top: 10px; right: 15px; font-size: 30px; color: white; cursor: pointer; 
                background: rgba(0,0,0,0.6); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">&times;</span>
            <img id="modalImage" style="width: auto; max-width: 100%; max-height: 80vh; display: block; border-radius: 5px;" />
            <p id="modalCaption" style="color: white; margin-top: 10px; font-size: 16px; text-align: center;"></p>
        </div>
    `;
    document.body.appendChild(modal);

    images.forEach(img => {
        const captionElement = img.nextElementSibling;
        if (captionElement) {
            captionElement.style.display = "none"; // Hide caption in the gallery card
        }

        img.addEventListener("click", function () {
            const modalImage = document.getElementById("modalImage");
            const modalCaption = document.getElementById("modalCaption");
            modalImage.src = this.src;
            modalCaption.textContent = captionElement ? captionElement.textContent : "";
            modal.style.display = "flex";
        });
    });

    document.getElementById("closeModal").addEventListener("click", function () {
        modal.style.display = "none";
    });

    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
    </script>
@endsection
