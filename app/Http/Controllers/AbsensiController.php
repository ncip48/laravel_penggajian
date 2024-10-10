<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\PotonganGaji;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $absensis = Absensi::all();
        if ($request->bulan && $request->tahun) {
            $absensis = Absensi::whereMonth('bulan', $request->bulan)
                ->whereYear('bulan', $request->tahun)
                ->get();
        }
        return view('absensi.index')
            ->with('absensis', $absensis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = $this->getKaryawans();
        return view('absensi.action')
            ->with('karyawans', $karyawans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'bulan' => 'required',
            'masuk' => 'required',
            'izin' => 'required',
            'alpha' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'masuk.required' => 'Jumlah hari masuk tidak boleh kosong',
            'izin.required' => 'Jumlah hari izin tidak boleh kosong',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        Absensi::create($request->all());

        return $this->setResponse(true, "Sukses membuat absensi");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawans = $this->getKaryawans();
        $data = Absensi::find($id);
        $data->bulan = Carbon::parse($data->bulan)->format('Y-m');
        return view('absensi.action')
            ->with('data', $data)
            ->with('karyawans', $karyawans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->removeUnused($request);

        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'bulan' => 'required',
            'masuk' => 'required',
            'izin' => 'required',
            'alpha' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'masuk.required' => 'Jumlah hari masuk tidak boleh kosong',
            'izin.required' => 'Jumlah hari izin tidak boleh kosong',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        Absensi::where('id_absensi', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update absensi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Absensi::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return $this->setResponse(true, "Sukses hapus absensi");
        } else {
            return $this->setResponse(true, "Gagal hapus absensi");
        }
    }

    public function cariAbsensi(Request $request)
    {
        $absensi = Absensi::whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        if ($absensi) {
            return $this->setResponse(true, "Sukses get absensi", $absensi);
        } else {
            return $this->setResponse(false, "Absensi tidak ditemukan", []);
        }
    }

    public function cariAbsensiLembur(Request $request)
    {
        $gaji_pokok = Karyawan::with('jabatan')->where('id_karyawan', $request->id_karyawan)->first();

        $potongan = PotonganGaji::whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        $lembur = Lembur::whereMonth('tanggal', $request->bulan)
            ->whereYear('tanggal', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->get();

        $absensi = Absensi::select('izin', 'masuk', 'alpha')->whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        $obj = [];
        $obj['gaji']['uang_lembur'] = $gaji_pokok->jabatan->uang_lembur;
        $obj['gaji']['uang_makan'] = $gaji_pokok->jabatan->uang_makan;
        $obj['gaji']['tunjangan_transportasi'] = $gaji_pokok->jabatan->tunjangan_transportasi;
        $obj['gaji']['gaji_pokok'] = $gaji_pokok->jabatan->gaji_pokok;

        if ($absensi) {
            $obj['absensi'] = $absensi;
        } else {
            $obj['absensi']['izin'] = 0;
            $obj['absensi']['masuk'] = 0;
            $obj['absensi']['alpha'] = 0;
        }

        if ($potongan) {
            $obj['potongan'] = $potongan->potongan_gaji;
        } else {
            $obj['potongan'] = 0;
        }

        if ($lembur) {
            $obj['lembur'] = $lembur->pluck('jam')->sum();
        } else {
            $obj['lembur'] = 0;
        }

        return $this->setResponse(true, "Sukses get data", $obj);
    }
}
