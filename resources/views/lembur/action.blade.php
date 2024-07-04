<?php
$is_edit = isset($data);
?>

@extends('layouts.app')

@section('title', $is_edit ? 'Edit Lembur' : 'Tambah Lembur')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $is_edit ? 'Edit' : 'Tambah' }} Lembur</h1>
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
                                {{ $is_edit ? 'Edit' : 'Tambah' }} Lembur
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
                                <h3 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Lembur</h3>
                            </div>
                            <form id="main-form"
                                action="{{ $is_edit ? route('lembur.update', $data) : route('lembur.store') }}"
                                method="POST" autocomplete="off" data-back="{{ route('lembur.index') }}">
                                @csrf
                                {!! $is_edit ? method_field('PUT') : '' !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="id_karyawan">Karyawan</label>
                                        <select class="custom-select form-control-sm" id="id_karyawan" name="id_karyawan"
                                            @if (isset($data)) readonly @endif>
                                            <option value="" selected disabled>Pilih Karyawan</option>
                                            @foreach ($karyawans as $item)
                                                <option value="{{ $item->id_karyawan }}"
                                                    @if (isset($data->id_karyawan) && $item->id_karyawan == $data->id_karyawan) selected @endif>
                                                    {{ $item->nama_karyawan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="{{ isset($data->tanggal) ? $data->tanggal : '' }}"
                                            @if (isset($data)) readonly @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="jam">Jumlah Jam</label>
                                        <input type="text" class="form-control" id="jam" name="jam"
                                            value="{{ isset($data->jam) ? $data->jam : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            value="{{ isset($data->keterangan) ? $data->keterangan : '' }}">
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
