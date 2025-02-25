@extends('layouts.main')

@section('content')
<section class="counts section-bg">
    <div class="container">
  
      <div class="section-title">
        <h2>Berita Desa</h2>
      </div>
  
      <div class="row">
        <!-- @foreach ($beritas as $berita)
            <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                <div class="count-box news-card">
                    <div class="card">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <div class="news-date">{{ $berita->created_at->diffForHumans() }}</div>
                            <p class="card-text">{{ $berita->excerpt }}</p>                           
                        </div>
                        <div class="card-footer">
                            <a href="/berita/{{ $berita->slug }}" type="button" class="btn btn-link float-end">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach -->
        @if ($beritas->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted">Tidak terdapat berita untuk saat ini.</p>
            </div>
        @else
            @foreach ($beritas as $berita)
                <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                    <div class="count-box news-card">
                        <div class="card" onclick="window.location.href='/berita/{{ $berita->slug }}'" style="cursor: pointer;">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <div class="news-date">{{ $berita->created_at->diffForHumans() }}</div>
                                <p class="card-text">{{ $berita->excerpt }}</p>                           
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
      </div>

      {{ $beritas->links() }}

    </div>
  </section>
@endsection