@extends('layouts.main')

@section('content')
<section class="counts section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Detail Program</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row p-4">
                        <div class="col-lg-4">
                            <img src="{{ asset('storage/' . $program->foto) }}" alt="Gambar Program" class="img-fluid">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body">
                                <h2 class="card-title"><b>{{ $program->program }}</b></h2>
                                <p>{!! $program->deskripsi !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
