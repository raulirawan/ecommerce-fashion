@extends('layouts.dashboard')

@section('title','Halaman Produk')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Produk</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Produk</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tabel Produk</strong>
                        <button data-toggle="modal" data-target="#modal-create" class="btn btn-info btn-sm mb-3 float-right">Tambah Produk</button>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Gambar</th>
                                        <th>Harga</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->kategori->nama_kategori }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>
                                                <img src="{{ url($item->gambar) }}" style="width: 100px">
                                            </td>
                                            <td>Rp{{ number_format($item->harga) }}</td>
                                            <td>
                                                <button
                                                id="edit"
                                                data-toggle="modal"
                                                data-target="#modal-edit"
                                                class="btn btn-primary btn-sm float-left mr-1"
                                                data-id="{{ $item->id }}"
                                                data-nama_produk="{{ $item->nama_produk }}"
                                                data-kategori="{{ $item->kategori->id }}"
                                                data-stok="{{ $item->stok }}"
                                                data-gambar="{{ $item->gambar }}"
                                                data-harga="{{ $item->harga }}"
                                                >Edit</button>
                                                <form action="{{ route('admin.produk.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ?')">Hapus</button>
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
    </div><!-- .animated -->
</div><!-- .content -->
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Produk</label>
                        <input type="text" class="form-control"
                            value="{{ old('nama_produk') }}" name="nama_produk" placeholder="Masukan Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required readonly>
                            <option value="{{ $item->kategori->first()->id }}">{{ $item->kategori->first()->nama_kategori }}</option>
                            {{-- @foreach ($kategoris = App\Kategori::all() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="number" class="form-control"
                            value="{{ old('stok') }}" name="stok" placeholder="Masukan Stok" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gambar</label>
                        <input type="file" class="form-control"
                             name="gambar" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="number" class="form-control"
                            value="{{ old('harga') }}" name="harga" placeholder="Masukan Harga" required>
                    </div>
                </div>

            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
        </form>

    </div>
</div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Produk</label>
                        <input type="text" class="form-control"
                            value="{{ old('nama_produk') }}" id="nama_produk" name="nama_produk" placeholder="Masukan Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kategori</label>
                        <select name="kategori_id" id="kategori_edit" class="form-control" required readonly>
                            {{-- @foreach ($kategoris = App\Kategori::all() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach --}}
                            <option value="{{ $item->kategori->first()->id }}">{{ $item->kategori->first()->nama_kategori }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stok</label>
                        <input type="number" class="form-control"
                            value="{{ old('stok') }}" name="stok" id="stok" placeholder="Masukan Stok" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gambar</label>
                        <input type="file" class="form-control"
                             name="gambar">
                        <img src="" alt="" id="gambar" class="mt-2" style="width: 100px">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga</label>
                        <input type="number" class="form-control"
                            value="{{ old('harga') }}" name="harga" id="harga" placeholder="Masukan Harga" required>
                    </div>
                </div>

            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
        </form>

    </div>
</div>
</div>
@push('down-script')
<script>
    $(document).on('click', '#edit', function(){
        var id = $(this).data('id');
        var nama_produk = $(this).data('nama_produk');
        var kategori = $(this).data('kategori');
        var stok = $(this).data('stok');
        var gambar = $(this).data('gambar');
        var harga = $(this).data('harga');
        var url = '{{ url('/') }}';

        $('#nama_produk').val(nama_produk);
        $('#kategori_edit').val(kategori).change();
        $('#stok').val(stok);
        $('#gambar').attr('src', url + '/' + gambar);
        $('#harga').val(harga);

        $('#form-edit').attr('action','/admin/produk/update/' + id);
    });
</script>
<script src="{{ asset('/') }}assets/js/lib/data-table/datatables.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/jszip.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="{{ asset('/') }}assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="{{ asset('/') }}assets/js/init/datatables-init.js"></script>
@endpush
@endsection
