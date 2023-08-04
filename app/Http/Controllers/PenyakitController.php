<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class PenyakitController extends Controller
{
    public function index()
    {
        $data = Penyakit::get();

        return view('modul.penyakit', [
            "title" => "Penyakit",
            "data" => $data
        ]);
    }

    public function tambah(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "kode_penyakit" => "required",
            "nama_penyakit" => "required",
            "solusi" => "required",
        ]);

        if($validation->fails()){
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Semua data wajib diisi"
            ]);
        }

        $cek = Penyakit::where('kode_penyakit', $request->kode_penyakit)->get();
        if (count($cek) > 0) {
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Penyakit sudah ditambahkan"
            ]);
        }

        $set = [
            "id" => Uuid::uuid4()->getHex(),
            "kode_penyakit" => $request->kode_penyakit,
            "nama_penyakit" => $request->nama_penyakit,
            "solusi" => $request->solusi,
        ];


        DB::beginTransaction();
        $modul = Penyakit::create($set);

        try {
            if (!$modul->save()) {
                return Redirect::back()->with([
                    'alert' => 0,
                    'message' => "Terjadi kesalahan dalam menyimpan data"
                ]);
            }

            DB::commit();
            $msg = "Berhasil menambah data";

            return Redirect::to('penyakit')->with([
                'alert' => 1,
                'message' => 'Berhasil menambah data'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Terjadi kesalahan: $th"
            ]);
        }
    }

    public function show_edit(Request $request)
    {
        $get_data = Penyakit::find($request->id);
        $data['kode_penyakit'] = $get_data->kode_penyakit;
        $data['nama_penyakit'] = $get_data->nama_penyakit;
        $data['solusi'] = $get_data->solusi;

        return $data;
    }

    public function edit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "kode_penyakit" => "required",
            "nama_penyakit" => "required",
            "solusi" => "required"
        ]);

        if($validation->fails()){
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Terjadi Kesalahan input"
            ]);
        }

        $cek = Penyakit::where('kode_penyakit', $request->kode_penyakit)->where('id', '!=', $request->id)->get();
        if (count($cek) > 0) {
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Penyakit sudah ditambahkan"
            ]);
        }

        DB::beginTransaction();

        $data = Penyakit::find($request->id);
        $data->kode_penyakit = $request->kode_penyakit;
        $data->nama_penyakit = $request->nama_penyakit;
        $data->solusi = $request->solusi;

        try {
            if (!$data->update()) {
                return Redirect::to('penyakit')->with([
                    'alert' => 0,
                    'message' => 'Gagal mengubah data'
                ]);
            }

            DB::commit();
            return Redirect::to('penyakit')->with([
                'alert' => 1,
                'message' => 'Berhasil mengubah data'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::to('gejala')->with([
                'alert' => 0,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function hapus(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = Penyakit::find($request->id);

            if ($data->delete()) {
                DB::commit();
                return Redirect::to('penyakit')->with([
                    'alert' => 1,
                    'message' => 'Berhasil menghapus data'
                ]);
            } else {
                return Redirect::to('penyakit')->with([
                    'alert' => 0,
                    'message' => 'Gagal menghapus data'
                ]);
            }
        } catch (\Throwable $th) {
            return Redirect::to('penyakit')->with([
                'alert' => 0,
                'message' => "Terjadi Kesalahan $th"
            ]);
        }
    }
}
