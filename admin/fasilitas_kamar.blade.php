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
                  <h2 class="title-mobile mt-4"><b>Fasilitas Kamar</b></h2>
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
                                  <th>Tipe Kamar</th>
                                  <th>Fasilitas</th>
                                  <th>Gambar</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fasilitas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kamar->tipe_kamar }}</td>
                                    <td>{{ $data->fasilitas }}</td>
                                    <td><a href="/images/fasilitas/{{ $data->name_img }}" target="_blank">preview image</a></td>
                                    <td>
                                        <button class="btn btn-sm btn-success mx-1" data-toggle="modal" data-target="#editFasilitasKamar{{ $data->id }}" style="float:left;"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-secondary mx-1" data-toggle="modal"data-target="#hapusDataModal" style="float:left;"><i class="fa-solid fa-eye"></i></button>
                                        <form action="/fasilitas-kamar/{{ $data->id }}" method="post" style="float:left;" class="mx-1">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
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
    {{-- modal tambah --}}
    <div class="modal fade" id="tambahFasilitasKamar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahFasilitasKamarLabel" aria-hidden="true" >
        <form class="mt-1" action="/fasilitas-kamar" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahFasilitasKamarLabel">Tambah Fasilitas Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="background-color: #e4e9f7">
                    @csrf  
                    <div class="mb-3">
                        <label class="form-label">Tipe Kamar :</label>
                        <select required name="kamar_id" id="kamar_id" class="form-select">
                            @foreach ($kamar as $data1)
                            <option value="{{ $data1->id }}">{{ $data1->tipe_kamar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fasilitas :</label>
                        <input required type="text" class="form-control" id="fasilitas" name="fasilitas">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Tampilan :</label>
                        <input required type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Simpan</button>
                </div>
                </div>
            </div>
        </form>
    </div>
    {{-- modal edit --}}
    @foreach($fasilitas as $data)
    <div class="modal " id="editFasilitasKamar{{ $data->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="editFasilitasKamar{{ $data->id }}Label" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFasilitasKamar{{ $data->id }}Label">Edit Fasilitas Kamar</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="/fasilitas-kamar/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="background-color: #e4e9f7">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label class="form-label">Tipe Kamar :</label>
                            <select required class="form-select" id="kamar_id" name="kamar_id">
                                <option value="{{ $data->kamar_id }}">{{ $data->kamar->tipe_kamar }}</option>
                                @foreach ($kamar as $data1)
                                <option value="{{ $data1->id }}" {{ $data1->id === $data->kamar_id ? 'hidden' : '' }}>{{ $data1->tipe_kamar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fasilitas :</label>
                            <input required  value="{{ $data->fasilitas }}" type="text" class="form-control" name="fasilitas" id="fasilitas">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar Tampilan :</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan Perubahan?')">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  	});
    $(function () {
        var table = $('.yajra-datatable').DataTable({
          dom: 'l<"toolbar">frtip',
            initComplete: function(){
            $("div.toolbar")
                .html('<a type="button" class="create p-2 px-3 mb-2 btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#tambahFasilitasKamar"><i class="bi bi-plus-lg text-light"></i><span class="text-light">Tambah</span></a>');           
            },  
      });
      
    });
    </script>
    @endpush
@endsection