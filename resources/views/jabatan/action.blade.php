<?php
$is_edit = isset($data);
?>

@extends('layouts.app')

@section('title', $is_edit ? 'Edit Jabatan' : 'Tambah Jabatan')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $is_edit ? 'Edit' : 'Tambah' }} Jabatan</h1>
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
                                {{ $is_edit ? 'Edit' : 'Tambah' }} Jabatan
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
                                <h3 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Jabatan</h3>
                            </div>
                            <form id="main-form"
                                action="{{ $is_edit ? route('jabatan.update', $data) : route('jabatan.store') }}"
                                method="POST" autocomplete="off" data-back="{{ route('jabatan.index') }}">
                                @csrf
                                {!! $is_edit ? method_field('PUT') : '' !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_jabatan">Nama Jabatan</label>
                                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                                            value="{{ isset($data->nama_jabatan) ? $data->nama_jabatan : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="gaji_pokok">Gaji Pokok</label>
                                        <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok"
                                            value="{{ isset($data->gaji_pokok) ? $data->gaji_pokok : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="uang_lembur">Uang Lembur (/jam)</label>
                                        <input type="text" class="form-control" id="uang_lembur" name="uang_lembur"
                                            value="{{ isset($data->uang_lembur) ? $data->uang_lembur : '' }}">
                                        <small class="text-xs text-muted">Masukkan nominal uang lembur per jam</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tunjangan_transportasi">Tunjangan Transportasi</label>
                                        <input type="text" class="form-control" id="tunjangan_transportasi"
                                            name="tunjangan_transportasi"
                                            value="{{ isset($data->tunjangan_transportasi) ? $data->tunjangan_transportasi : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="uang_makan">Uang Makan (/hari)</label>
                                        <input type="text" class="form-control" id="uang_makan" name="uang_makan"
                                            value="{{ isset($data->uang_makan) ? $data->uang_makan : '' }}">
                                        <small class="text-xs text-muted">Masukkan nominal uang makan per hari</small>
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
