@extends('kerangka.master')
@section('title', 'Tabel User')
@section('content')
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-center">Tabel User</h4>
                        <div>
                            <a class="btn btn-success" href="{{ route('user.create') }}">Tambah</a>
                            <a class="btn btn-primary" href="{{ route('user.export') }}">Export</a>
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-content">
                        <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-1">
                                    <input type="text" name="name" class="form-control" placeholder="Filter by Name" value="{{ request()->name }}">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="email" class="form-control" placeholder="Filter by Email" value="{{ request()->email }}">
                                </div>
                                <div class="col-md-1">
                                    <select name="peran" class="form-control">
                                        <option value="">All</option>
                                        <option value="admin" {{ request()->peran == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="staff" {{ request()->peran == 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="pimpinan" {{ request()->peran == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                                        <option value="dosen" {{ request()->peran == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                        <option value="mahasiswa" {{ request()->peran == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Fungsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <span class="badge {{
                                                $item->peran == 'admin' ? 'bg-danger' :
                                                ($item->peran == 'staff' ? 'bg-success' :
                                                ($item->peran == 'pimpinan' ? 'bg-primary' :
                                                ($item->peran == 'dosen' ? 'bg-warning' : 'bg-info')))
                                            }}">
                                                {{ ucfirst($item->peran) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary btn-sm me-2" href="{{ route('user.show', $item->id) }}">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                                @if ($item->peran !== 'admin')
                                                    <a class="btn btn-primary btn-sm me-2" href="{{ route('user.edit', $item->id) }}">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary btn-sm me-2" disabled>
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                @endif
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button">
                                                        <i class="bi bi-trash-fill"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
@endsection
