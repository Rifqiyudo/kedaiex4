@extends('layouts.admin')

@section('title', 'Kelola Promo')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Kelola Promo</h1>
        <a href="{{ route('admin.promo.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Promo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Promo</th>
                            <th>Deskripsi</th>
                            <th>Diskon</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promos as $promo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $promo->nama }}</td>
                            <td>{{ $promo->deskripsi }}</td>
                            <td>{{ $promo->diskon }}%</td>
                            <td>{{ ucfirst($promo->status) }}</td>
                            <td>{{ $promo->tanggal_mulai }}</td>
                            <td>{{ $promo->tanggal_berakhir }}</td>
                            <td>
                                <a href="{{ route('admin.promo.edit', $promo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus promo?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data promo</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 