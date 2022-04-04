@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.css"/>
@endpush

@section('content')
    <section class="home-section">
    <div class="container-fluid" style="min-height: calc(100vh - 60px);">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row pb-1 mb-1">
                <div class="col-sm-6">
                  <h2 class="title-mobile mt-4"><b>Reservasi</b></h2>
                </div>
                <hr class="mt-3 ms-2 mb-1">
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row py-2">
                <div class="col">
                    <div class="card-body p-0 ms-1 mb-5" style="overflow-x: auto;">
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Tamu</th>
                                  <th>Tipe Kamar</th>
                                  <th>Jumlah</th>
                                  <th>Tanggal Cek In</th>
                                  <th>Tanggal Cek Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservasi as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->tamu->nama }}</td>
                                    <td>{{ $data->tipe_kamar }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>{{ $data->tanggal_in }}</td>
                                    <td>{{ $data->tanggal_out }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    </section>
    @push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  	});
    $(function () {
        var table = $('.yajra-datatable').DataTable();
      
    });
    </script>
    @endpush
@endsection