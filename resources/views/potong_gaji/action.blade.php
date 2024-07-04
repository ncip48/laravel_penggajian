<?php
$is_edit = isset($data);
?>

@extends('layouts.app')

@section('title', $is_edit ? 'Edit Potongan' : 'Tambah Potongan')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $is_edit ? 'Edit' : 'Tambah' }} Potongan</h1>
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
                                {{ $is_edit ? 'Edit' : 'Tambah' }} Potongan
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
                                <h3 class="card-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Potongan</h3>
                            </div>
                            <form id="main-form"
                                action="{{ $is_edit ? route('potong-gaji.update', $data) : route('potong-gaji.store') }}"
                                method="POST" autocomplete="off" data-back="{{ route('potong-gaji.index') }}">
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
                                        <label for="bulan">Bulan</label>
                                        <input type="month" class="form-control" id="bulan" name="bulan"
                                            value="{{ isset($data->bulan) ? $data->bulan : '' }}"
                                            @if (isset($data)) readonly @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="alpha">Alpha</label>
                                        <input type="text" class="form-control" id="alpha" name="alpha"
                                            value="{{ isset($data->alpha) ? $data->alpha : '' }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="potongan_gaji">Potongan Gaji</label>
                                        <input type="text" class="form-control" id="potongan_gaji" name="potongan_gaji"
                                            value="{{ isset($data->potongan_gaji) ? $data->potongan_gaji : '' }}">
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

@push('scripts')
    <script>
        $('#id_karyawan, #bulan').on('change', function() {
            const id_karyawan = $('#id_karyawan').val();
            const periode = $('#bulan').val();
            if (id_karyawan && periode) {
                const bulan = periode.split('-')[1]
                const tahun = periode.split('-')[0]

                $.ajax({
                    url: "{{ route('absen.cari') }}",
                    method: 'POST',
                    data: {
                        'id_karyawan': id_karyawan,
                        'bulan': bulan,
                        'tahun': tahun
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        if (data.success) {
                            $('#alpha').val(data?.data?.alpha)
                        } else {
                            toastr.error(data?.message)
                            $('#alpha').val(0)
                        }
                    },
                    error: function(err) {
                        toastr.error(err.statusText)
                    }
                });
            }
        });
    </script>
@endpush
