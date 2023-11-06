@extends('layouts.app')

@section('content')

<section class="py-5" style="margin-top: 100px">
    <div class="container col-xxl-8">
        
        <h4>Halaman Transaksi</h4>

        {{-- <a href="{{ route('blog.create') }}" class="btn btn-primary">Buat Artikel</a> --}}

        {{-- PESAN SUKSES --}}
        {{-- @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Informasi</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
            
        @endif --}}

        <div class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">Tambah Data</div>


        <div class="table-responsive py-3">
            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Transaksi</th>
                            <th>Jenis Transaksi</th>
                            <th>Nominal Transaksi</th>
                            <th>Keterangan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>

                            
                        </tr>
                    </thead>
               
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($transaksi as $data)
                        
                  

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                {{ $data->nama_transaksi }}
                            </td>
                            <td>
                                @if ($data->jenis_transaksi === 'pemasukan')
                                    <button class="btn btn-success" disabled>{{ $data->jenis_transaksi }}</button>
                                @elseif ($data->jenis_transaksi === 'pengeluaran')
                                    <button class="btn btn-danger" disabled>{{ $data->jenis_transaksi }}</button>
                                @else
                                    {{ $data->jenis_transaksi }}
                                @endif
                            </td>
                            <td>
                                {{ $data->nominal }}
                            </td>
                            <td>
                                {{ $data->keterangan }}
                            </td>
                            <td>
                                {{ $data->created_at->format('d-m-Y H:i:s') }}
                            </td> 
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $data->id }}">Edit</button>
                                    <form method="POST" action="{{ route('transaksi.destroy', $data->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                             
                        </tr>
                       

                        @endforeach

                </tbody>

            </table>
        
            
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulir untuk menambahkan data -->
                <form method="POST" action="{{ route('transaksi.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_transaksi">Nama Transaksi</label>
                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_transaksi">Jenis Transaksi</label>
                        <select class="form-control" id="jenis_transaksi" name="jenis_transaksi" required>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal Transaksi</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="id_user" value="{{ $idUser }}">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($transaksi as $data)

    <!-- Modal Edit Transaksi -->
    <div class="modal" id="editModal{{ $data->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Transaksi</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transaksi.update', $data->id) }}">
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <label for="nama_transaksi">Nama Transaksi</label>
                            <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" value="{{ $data->nama_transaksi }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_transaksi">Jenis Transaksi</label>
                            <select class="form-control" id="jenis_transaksi" name="jenis_transaksi" required>
                                <option value="pemasukan" {{ $data->jenis_transaksi == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ $data->jenis_transaksi == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="nominal">Nominal Transaksi</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ $data->nominal }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $data->keterangan }}</textarea>

                        </div>
                        <input type="hidden" name="id_user" value="{{ $idUser }}">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endforeach


</section>

@endsection