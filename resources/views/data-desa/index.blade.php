@extends('layouts.main')

@section('content')
<section class="counts section-bg">
    <div class="container">
      <div class="row my-4">
        <div class="section-title">
            <h2>Data Penduduk</h2>
        </div>
        <div>
            <div class="card">
                <div class="card-body">
                    <h5 style="text-align: center;">Cangkring memiliki penduduk sebanyak <b>{{ $jumlahTotal }}</b> orang.</h5>
                </div>
            </div>
        </div>
    </div>
    
      <div class="row my-4">
        <div class="section-title">
            <h2>Data Jumlah Warga Per Rt</h2>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nama Rt</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penrts as $penrt)
                                    <tr>
                                        <td>{{ $penrt->rt }}</td> <!-- Gunakan variabel perulangan yang benar -->
                                        <td>{{ $penrt->jumlah }}</td> <!-- Pastikan kolom 'jumlah' ada dalam database -->
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-warning">
                                <tr>
                                    <td>Total </td>
                                    <td>{{ $totalPenRt}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="penRtChart" style="height: 400px; overflow: auto;"></canvas>
                    </div>                          
                </div>
            </div>
        </div>
      </div>
    
      <div class="row my-4">
        <div class="section-title">
            <h2>Data Jenis Kelamin</h2>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataJenisKelamins as $dataJenisKelamins)
                                <tr>
                                    <td>{{ $dataJenisKelamins->jenis_kelamin }}</td>
                                    <td>{{ $dataJenisKelamins->jumlah }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-warning">
                                <tr>
                                    <td>Total </td>
                                    <td>{{ $jumlahTotal }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="jenisKelaminChart" style="max-height: 400px; overflow: auto;"></canvas>
                    </div>                          
                </div>
            </div>
        </div>
      </div>

      <div class="row my-4">
        <div class="section-title">
            <h2>Data Agama</h2>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Penganut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataAgamas as $agama)
                                <tr>
                                    <td>{{ $agama->agama }}</td>
                                    <td>{{ $agama->penganut }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-warning">
                                <tr>
                                    <td>Total </td>
                                    <td>{{ $totalPenganut }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="agamaChart"></canvas>
                    </div>                          
                </div>
            </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="section-title">
            <h2>Data Pekerjaan</h2>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Pekerjaan</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pekerjaans as $pekerjaan)
                                <tr>
                                    <td>{{ $pekerjaan->pekerjaan }}</td>
                                    <td>{{ $pekerjaan->jumlah }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-warning">
                                <tr>
                                    <td>Total </td>
                                    <td>{{ $totalPekerjaan }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="pekerjaanChart" style="max-height: 350px; overflow: auto;"></canvas>
                    </div>                          
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    const ctxPekerjaan = document.getElementById('pekerjaanChart');
    
    const labelPekerjaan  = {!! $labelPekerjaan !!};
    const dataPekerjaan   = {!! $jumlahPekerjaan !!};

    new Chart(ctxPekerjaan, {
        type: 'bar',
        data: {
            labels: labelPekerjaan,
            datasets: [{
                label: 'Jumlah Pekerjaan',
                data: dataPekerjaan,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                ],
                hoverOffset: 4
            }]
        }
    });
</script>


<script>
  const ctxAgama = document.getElementById('agamaChart');

  const labels = {!! $labels !!}; // Pastikan ini array label (misalnya: ['Islam', 'Katolik', 'Protestan'])
  const dataPenganut = {!! $dataPenganut !!}; // Pastikan ini array dengan jumlah sama seperti labels

  new Chart(ctxAgama, {
    type: 'bar',
    data: {
      labels: labels, // Label kategori untuk sumbu X
      datasets: [{
        label: 'Jumlah Penganut', // Label untuk legend dan tooltip
        data: dataPenganut, // Data yang sesuai dengan labels
        backgroundColor: [
          '#FF5733', // Oranye kemerahan
          '#8E44AD', // Ungu tua
          '#2ECC71', // Hijau segar
          '#F1C40F', // Kuning emas
          '#3498DB', // Biru muda
          '#E74C3C'  // Merah menyala (Tambahan)
        ],
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true, // Menampilkan legend
          position: 'top'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Jumlah Penganut' // Label sumbu Y
          }
        },
        x: {
          title: {
            display: true,
            text: 'Agama' // Label sumbu X
          }
        }
      }
    }
  });
</script>

  
  <script>
    const ctxJenisKelamin = document.getElementById('jenisKelaminChart');
    const labelsJenisKelamin = {!! $labelsJenisKelamin !!};
    const jumlah = {!! $jumlah !!};

    new Chart(ctxJenisKelamin, {
        type: 'pie', 
        data: {
            labels: labelsJenisKelamin,
            datasets: [{
                label: 'Jumlah Jenis Kelamin',
                data: jumlah,
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctxPenRt = document.getElementById('penRtChart').getContext('2d');

        const labelPenRt = @json($labelPenRt);
        const dataPenRt = @json($jumlahPenRt);

        new Chart(ctxPenRt, {
            type: 'bar',
            data: {
                labels: labelPenRt,
                datasets: [{
                    label: 'Jumlah Penduduk Per RT',
                    data: dataPenRt,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>


  
@endsection

