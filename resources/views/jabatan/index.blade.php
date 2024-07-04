@extends('layouts.app')

@section('title', 'Jabatan')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Jabatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Master Data</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Jabatan
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
                                    <h3 class="card-title mt-1">
                                        Daftar Jabatan
                                    </h3>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-primary mt-1" href="{{ route('jabatan.create') }}"><i
                                                class="fas fa-plus"></i>
                                            Add Jabatan</a>
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
                                                <th>Nama Jabatan</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan Transportasi</th>
                                                <th>Uang Makan</th>
                                                <th>Uang Lembur</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jabatans as $index => $jabatan)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $jabatan->nama_jabatan }}</td>
                                                    <td>@currency($jabatan->gaji_pokok)</td>
                                                    <td>@currency($jabatan->tunjangan_transportasi)</td>
                                                    <td>@currency($jabatan->uang_makan)/hari</td>
                                                    <td>@currency($jabatan->uang_lembur)/jam</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('jabatan.edit', $jabatan->id_jabatan) }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form data-reload="true" id="main-form"
                                                                action="{{ route('jabatan.destroy', $jabatan) }}"
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
