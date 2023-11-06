@extends('layouts.app')

@section('content')

<section class="py-5" style="margin-top: 100px">
    <div class="container col-xxl-8">
        
        <h4>Halaman Setting Dashboard Main</h4>

        {{-- <a href="{{ route('blog.create') }}" class="btn btn-primary">Buat Artikel</a> --}}

        {{-- PESAN SUKSES --}}
        {{-- @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Informasi</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
            
        @endif --}}

        <div class="table-responsive py-3">
            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Setting</th>
                            <th>Jumlah</th>
                            
                        </tr>
                    </thead>
               
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($datas as $data)
                        
                  

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                Total Uang
                            </td>
                            <td>
                                {{ $data->total_uang }}
                            </td>
                            
                            
                        </tr>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                Total Uang Sepatu Kulit
                            </td>
                            <td>
                                {{ $data->total_uang_sepatukulit }}
                            </td>
                         
                            
                        </tr>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                Total Uang Sepatu Bahan
                            </td>
                            <td>
                                {{ $data->total_uang_sepatubahan }}
                            </td>
                          
                            
                        </tr>

                        <!-- Tambahkan kode ini di dalam loop foreach untuk setiap data -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal{{ $data->id }}">
    Edit
</button>

<!-- Modal Edit -->
<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('dashboardmain.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan input fields untuk mengedit data -->
                    <div class="form-group">
                        <label for="total_uang">Total Uang</label>
                        <input type="text" class="form-control" id="total_uang" name="total_uang" value="{{ $data->total_uang }}">
                    </div>
                    <div class="form-group">
                        <label for="total_uang_sepatukulit">Total Uang Sepatu Kulit</label>
                        <input type="text" class="form-control" id="total_uang_sepatukulit" name="total_uang_sepatukulit" value="{{ $data->total_uang_sepatukulit }}">
                    </div>
                    <div class="form-group">
                        <label for="total_uang_sepatubahan">Total Uang Sepatu Bahan</label>
                        <input type="text" class="form-control" id="total_uang_sepatubahan" name="total_uang_sepatubahan" value="{{ $data->total_uang_sepatubahan }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

                        @endforeach

                </tbody>

                

                
                
            </table>
        
            
        </div>
    </div>
</section>
</section>
@endsection