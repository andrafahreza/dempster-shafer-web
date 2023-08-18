<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class GejalaController extends Controller
{
    public function index()
    {
        $data = Gejala::get();

        return view('modul.gejala', [
            "title" => "Gejala",
            "data" => $data
        ]);
    }

    public function tambah(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "kode_gejala" => "required",
            "nama_gejala" => "required",
        ]);

        if($validation->fails()){
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Semua data wajib diisi"
            ]);
        }

        $cek = Gejala::where('kode_gejala', $request->kode_gejala)->get();
        if (count($cek) > 0) {
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Gejala sudah ditambahkan"
            ]);
        }

        $set = [
            "id" => Uuid::uuid4()->getHex(),
            "kode_gejala" => $request->kode_gejala,
            "nama_gejala" => $request->nama_gejala,
            "nilai_densitas" => $request->nilai_densitas,
        ];

        DB::beginTransaction();
        $modul = Gejala::create($set);

        try {
            if (!$modul->save()) {
                return Redirect::back()->with([
                    'alert' => 0,
                    'message' => "Terjadi kesalahan dalam menyimpan data"
                ]);
            }

            DB::commit();
            $msg = "Berhasil menambah data";

            return Redirect::to('gejala')->with([
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
        $get_data = Gejala::find($request->id);
        $data['kode_gejala'] = $get_data->kode_gejala;
        $data['nama_gejala'] = $get_data->nama_gejala;
        $data['nilai_densitas'] = $get_data->nilai_densitas;

        return $data;
    }

    public function edit(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "kode_gejala" => "required",
            "nama_gejala" => "required",
            "nilai_densitas" => "required"
        ]);

        if($validation->fails()){
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Terjadi Kesalahan input"
            ]);
        }

        $cek = Gejala::where('kode_gejala', $request->kode_gejala)->where('id', '!=', $request->id)->get();
        if (count($cek) > 0) {
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Gejala sudah ditambahkan"
            ]);
        }

        DB::beginTransaction();

        $data = Gejala::find($request->id);
        $data->kode_gejala = $request->kode_gejala;
        $data->nama_gejala = $request->nama_gejala;
        $data->nilai_densitas = $request->nilai_densitas;

        try {
            if (!$data->update()) {
                return Redirect::to('gejala')->with([
                    'alert' => 0,
                    'message' => 'Gagal mengubah data'
                ]);
            }

            DB::commit();
            return Redirect::to('gejala')->with([
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
            $data = Gejala::find($request->id);
            if ($data->delete()) {
                DB::commit();
                return Redirect::to('gejala')->with([
                    'alert' => 1,
                    'message' => 'Berhasil menghapus data'
                ]);
            } else {
                return Redirect::to('gejala')->with([
                    'alert' => 0,
                    'message' => 'Gagal menghapus data'
                ]);
            }
        } catch (\Throwable $th) {
            return Redirect::to('gejala')->with([
                'alert' => 0,
                'message' => "Terjadi Kesalahan $th"
            ]);
        }
    }

}
