<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Themestyle -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    {{-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icheck.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/iconpicker-1.5.0.css') }}" />
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="https://imsservice.co.id/assets/inka-border.png" alt="AdminLTELogo"
                height="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link d-flex">
                {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"> --}}
                <span class="brand-text font-weight-normal text-center w-100">Penggajian Karyawan</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="{{ Auth::user()->avatar ? asset('assets/img/avatar/' . Auth::user()->avatar) : asset('assets/img/default.png') }}"
                            class="img-circle" alt="User Image" style="height: 2.1rem">
                    </div>
                    <div class="info align-text-center" style="text-wrap:wrap">
                        <a class="d-block">{{ Auth::user()->name }}
                    </div>
                </div>

                {{-- <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('absensi.*') || request()->routeIs('lembur.*') || request()->routeIs('setting-potong-gaji.*') || request()->routeIs('gaji.*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->routeIs('absensi.*') || request()->routeIs('lembur.*') || request()->routeIs('setting-potong-gaji.*') || request()->routeIs('gaji.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Transaksi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->level == 0)
                                    <li class="nav-item">
                                        <a href="{{ route('absensi.index') }}"
                                            class="nav-link {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Absensi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('lembur.index') }}"
                                            class="nav-link {{ request()->routeIs('lembur.*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Lembur</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('setting-potong-gaji.index') }}"
                                            class="nav-link {{ request()->routeIs('setting-potong-gaji.*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Setting Potong</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('gaji.index') }}"
                                        class="nav-link {{ request()->routeIs('gaji.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Gaji</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (auth()->user()->level != 2)
                            <li
                                class="nav-item {{ request()->routeIs('karyawan.*') || request()->routeIs('jabatan.*') ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('karyawan.*') || request()->routeIs('jabatan.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->level != 2)
                                        <li class="nav-item">
                                            <a href="{{ route('karyawan.index') }}"
                                                class="nav-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Karyawan</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->level == 0)
                                        <li class="nav-item">
                                            <a href="{{ route('jabatan.index') }}"
                                                class="nav-link {{ request()->routeIs('jabatan.*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Data Jabatan</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        <li
                            class="nav-item {{ request()->routeIs('laporan.gaji') || request()->routeIs('laporan.absen') || request()->routeIs('slip.gaji') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->routeIs('laporan.gaji') || request()->routeIs('laporan.absen') || request()->routeIs('slip.gaji') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (auth()->user()->level == 0)
                                    <li class="nav-item">
                                        <a href="{{ route('laporan.gaji') }}"
                                            class="nav-link {{ request()->routeIs('laporan.gaji') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Laporan Gaji</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('laporan.absen') }}"
                                            class="nav-link {{ request()->routeIs('laporan.absen') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Laporan Absen</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('slip.gaji') }}"
                                        class="nav-link {{ request()->routeIs('slip.gaji') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Slip Gaji</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ubah-password') }}"
                                class="nav-link {{ request()->routeIs('ubah-password') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Ubah Password
                                </p>
                            </a>
                        </li>

                        <form action="{{ route('logout') }}" id="logout" method="POST">
                            @csrf
                        </form>
                        <li class="nav-item">
                            <a onclick="document.getElementById('logout').submit();" class="nav-link"
                                style="cursor: pointer">
                                <i class="nav-icon fa fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ now()->year }} </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                Template by AdminLTE <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}" type="text/javascript"></script>


    @stack('scripts')

    <div id="ajax-modal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true" data-close-on-escape="true"></div>

    <script>
        $(function() {
            $("#main_table").DataTable({
                "lengthChange": false,
                "autoWidth": true,
            })
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        function resetForm(el, exc) {
            exc = (typeof exc != 'undefined') ? exc : '';
            $('.select2, .selectbox', el).not(exc).val("").trigger("change");
            $(':input', el).not(':button, :submit, :reset, :radio' + ((exc.length > 0) ? ',' + exc : '')).val('').prop(
                'selected', false);
            $('label.custom-file-label').text('');
        }

        function getError(data) {
            if (data.hasOwnProperty('success')) {
                if (!data.success) {
                    if (data?.message?.toLowerCase().includes('validation')) {
                        const datas = data?.data;
                        for (const key in datas) {
                            if (datas.hasOwnProperty(key)) {
                                const element = datas[key];
                                toastr.error(element);
                            }
                        }
                    } else {
                        toastr.error(data.message);
                    }
                }
            } else {
                toastr.error(data.message);
            }
        }

        function showLoadingButton(btn) {
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-spinner fa-spin"></i>');
        }

        function hideLoadingButton(btn) {
            btn.attr('disabled', false);
            btn.html('Simpan');
        }

        //#GetIconPicker on click
        // $(document).on('click', '#GetIconPicker', function(e) {
        //     // alert('ok')
        // })

        //#main-form on submit
        $(document).on('submit', '#main-form', function(e) {
            e.preventDefault();
            var form = $(this);
            //get the data-reload="true" attribute
            var reload = form.data('reload');
            var back = form.data('back');
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        if (reload) {
                            setTimeout(() => {
                                location.reload();
                            }, 800);
                        } else if (back) {
                            setTimeout(() => {
                                location.href = back;
                            }, 800)
                        } else {
                            dataMaster.draw(false);
                        }
                    } else {
                        getError(data)
                    }
                },
                error: function(err) {
                    // console.log(err)
                    hideLoadingButton(btn_save);
                    toastr.error(err.statusText)
                }
            });
        });

        $(document).on('submit', '#main-form-file', function(e) {
            e.preventDefault();
            var form = $(this);
            //get the data-reload="true" attribute
            var reload = form.data('reload');
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            var formData = new FormData(this); // Create FormData object from the form

            // If you want to append additional data to FormData dynamically
            // formData.append('key', 'value');

            $.ajax({
                url: url,
                method: method,
                data: formData, // Pass formData directly
                processData: false, // Important: Don't process the data
                contentType: false, // Important: Don't set contentType
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        if (reload) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            dataMaster.draw(false);
                        }
                    } else {
                        getError(data);
                    }
                    closeModal($modal, data);
                }
            });
        });


        $(document).on('submit', '#main-form-input', function(e) {
            e.preventDefault();
            var form = $(this);
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            let formData = new FormData($('#main-form-input')[0]);

            $.ajax({
                url: url,
                method: method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        // dataMaster.draw(false);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        getError(data)
                    }
                    closeModal($modal, data);
                }
            });
        });

        $(".confirm-text").on("click", function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah yakin untuk menghapus data ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    deleteButton.closest("form").submit();
                }
            });
        })

        $(".acc-text").on("click", function(e) {
            e.preventDefault();
            var accButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Approve',
                text: 'Apakah yakin untuk approve gaji ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    accButton.closest("form").submit();
                }
            });
        })

        $(".tolak-text").on("click", function(e) {
            e.preventDefault();
            var accButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Tolak',
                text: 'Apakah yakin untuk menolak gaji ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    accButton.closest("form").submit();
                }
            });
        })
    </script>

    @if (Session::has('error'))
        <script>
            toastr.error('{!! Session::get('error') !!}');
        </script>
    @endif

    @if (Session::has('warning'))
        <script>
            toastr.warning('{!! Session::get('warning') !!}');
        </script>
    @endif
</body>

</html>
