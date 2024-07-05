<?php
$is_edit = isset($data);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $is_edit ? 'Edit' : 'Tambah' }} Absensi</h1>
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
                            {{ $is_edit ? 'Edit' : 'Tambah' }} Absensi
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Absensi</h3>
                        </div>
                        <form id="main-form"
                            action="{{ $is_edit ? route('absensi.update', $data) : route('absensi.store') }}"
                            method="POST" autocomplete="off" data-back="{{ route('absensi.index') }}">
                            @csrf
                            {!! $is_edit ? method_field('PUT') : '' !!}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_karyawan">Karyawan</label>
                                    <select class="custom-select form-control-sm" id="id_karyawan" name="id_karyawan">
                                        <option value="" selected disabled>Pilih Karyawan</option>
                                        @foreach ($karyawans as $item)
                                            <option value="{{ $item->id_karyawan }}"
                                                @if (isset($data->id_karyawan) && $item->id_karyawan == $data->id_karyawan) selected @endif>
                                                {{ $item->nama_karyawan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <input type="month" class="form-control" id="bulan" name="bulan"
                                        value="{{ isset($data->bulan) ? $data->bulan : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="masuk">Masuk</label>
                                    <input type="text" class="form-control" id="masuk" name="masuk"
                                        value="{{ isset($data->masuk) ? $data->masuk : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="izin">Izin</label>
                                    <input type="text" class="form-control" id="izin" name="izin"
                                        value="{{ isset($data->izin) ? $data->izin : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="alpha">Alpha</label>
                                    <input type="text" class="form-control" id="alpha" name="alpha"
                                        value="{{ isset($data->alpha) ? $data->alpha : '' }}">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button id="btn-save" type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
