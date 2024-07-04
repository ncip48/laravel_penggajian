@extends('layouts.app')

@section('title', 'Setting Potong Gaji')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Setting Potong Gaji</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Setting Potong Gaji
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h3 class="card-title mt-1">
                                            Daftar Setting Potong Gaji
                                        </h3>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-primary mt-1"
                                            href="{{ route('setting-potong-gaji.create') }}"><i class="fas fa-plus"></i>
                                            Tambah Potongan</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsives">
                                    <table class="table table-striped table-hover table-full-width" id="main_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Periode</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jumlah Potongan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($potongs as $index => $potong)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($potong->bulan)->locale('id')->isoFormat('MMMM Y') }}
                                                    </td>
                                                    <td>{{ $potong->karyawan->nik }}</td>
                                                    <td>{{ $potong->karyawan->nama_karyawan }}</td>
                                                    <td>@currency($potong->potongan_gaji)</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('setting-potong-gaji.edit', $potong->id_potong_gaji) }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form data-reload="true" id="main-form"
                                                                action="{{ route('setting-potong-gaji.destroy', $potong) }}"
                                                                method="POST" class="ml-1 delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="confirm-text btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $asets->links('vendor.pagination.bootstrap-4') }} --}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
