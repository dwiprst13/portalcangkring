@extends('layouts.main')

@section('content')
<section class="counts section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Program Dusun</h2>
        </div>
        <div class="row">
            @foreach ($programs as $program)
            <div class="col-lg-4 col-md-6 mb-3" data-aos="fade-up">
                <div class="count-box news-card">
                    <div class="card">
                        <img src="{{ asset('storage/' . $program->foto) }}" alt="Foto UMKM" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $program->program }}</b></h5>
                        </div>
                        <a class="btn btn-warning mx-3 mb-3" href="/program/{{ $program->slug }}" role="button"><i class="bi bi-eye"></i>&nbsp; Detail Program</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="paginate my-3" style="text-align: center">
            {{ $programs->links() }}
        </div>
    </div>
</section>
@endsection
