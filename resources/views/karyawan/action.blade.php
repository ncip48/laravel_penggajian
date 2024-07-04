<?php
$is_edit = isset($data);
?>

@extends('layouts.app')

@section('title', $is_edit ? 'Edit Karyawan' : 'Tambah Karyawan')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $is_edit ? 'Edit' : 'Tambah' }} Karyawan</h1>
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
                                {{ $is_edit ? 'Edit' : 'Tambah' }} Karyawan
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
                                <h3 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Karyawan</h3>
                            </div>
                            <form id="main-form"
                                action="{{ $is_edit ? route('karyawan.update', $data) : route('karyawan.store') }}"
                                method="POST" autocomplete="off" data-back="{{ route('karyawan.index') }}">
                                @csrf
                                {!! $is_edit ? method_field('PUT') : '' !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="id_jabatan">Jabatan</label>
                                        <select class="custom-select form-control-sm" id="id_jabatan" name="id_jabatan">
                                            <option value="" selected disabled>Pilih Jabatan</option>
                                            @foreach ($jabatans as $item)
                                                <option value="{{ $item->id_jabatan }}"
                                                    @if (isset($data->id_jabatan) && $item->id_jabatan == $data->id_jabatan) selected @endif>
                                                    {{ $item->nama_jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="{{ isset($data->nik) ? $data->nik : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_karyawan">Nama Karyawan</label>
                                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                                            value="{{ isset($data->nama_karyawan) ? $data->nama_karyawan : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelamin">Jenis Kelamin</label>
                                        <select class="custom-select form-control-sm" id="kelamin" name="kelamin">
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="L" @if (isset($data->kelamin) && $data->kelamin == 'L') selected @endif>
                                                Laki-Laki</option>
                                            <option value="P" @if (isset($data->kelamin) && $data->kelamin == 'P') selected @endif>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="custom-select form-control-sm" id="agama" name="agama">
                                            <option value="" selected disabled>Pilih Agama</option>
                                            <option value="Islam" @if (isset($data->agama) && $data->agama == 'Islam') selected @endif>Islam
                                            </option>
                                            <option value="Kristen" @if (isset($data->agama) && $data->agama == 'Kristen') selected @endif>
                                                Kristen</option>
                                            <option value="Katolik" @if (isset($data->agama) && $data->agama == 'Katolik') selected @endif>
                                                Katolik</option>
                                            <option value="Hindu" @if (isset($data->agama) && $data->agama == 'Hindu') selected @endif>Hindu
                                            </option>
                                            <option value="Budha" @if (isset($data->agama) && $data->agama == 'Budha') selected @endif>Budha
                                            </option>
                                            <option value="Lainnya" @if (isset($data->agama) && $data->agama == 'Lainnya') selected @endif>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_tinggal">Alamat Tinggal</label>
                                        <textarea rows="10" type="text" class="form-control" id="alamat_tinggal" name="alamat_tinggal">{{ isset($data->alamat_tinggal) ? $data->alamat_tinggal : '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telepon">No Telepon</label>
                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                            value="{{ isset($data->no_telepon) ? $data->no_telepon : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            value="{{ isset($data->tempat_lahir) ? $data->tempat_lahir : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            value="{{ isset($data->tanggal_lahir) ? $data->tanggal_lahir : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status_perkawinan">Status Perkawinan</label>
                                        <input type="text" class="form-control" id="status_perkawinan"
                                            name="status_perkawinan"
                                            value="{{ isset($data->status_perkawinan) ? $data->status_perkawinan : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tanggal_masuk"
                                            name="tanggal_masuk"
                                            value="{{ isset($data->tanggal_masuk) ? $data->tanggal_masuk : '' }}">
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
@endsection
