<?php

namespace App\Http\Controllers;

use App\Models\BasisPengetahuan;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class RuleController extends Controller
{
    public function index()
    {
        $data = BasisPengetahuan::groupBy("id_penyakit")->get();
        $penyakit = Penyakit::orderBy("kode_penyakit")->get();
        $gejala = Gejala::orderBy("kode_gejala")->get();

        return view('modul.basis-pengetahuan', [
            "title" => "Basis Pengetahuan",
            "data" => $data,
            "penyakit" => $penyakit,
            "gejala" => $gejala
        ]);
    }

    public function tambah(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "id_penyakit" => "required",
            "gejala" => "required",
        ]);

        if($validation->fails()){
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "penyakit dan gejala wajib diisi"
            ]);
        }

        $cek = BasisPengetahuan::where('id_penyakit', $request->id_penyakit)->get();
        if (count($cek) > 0) {
            return Redirect::back()->with([
                'alert' => 0,
                'message' => "Basis Pengetahuan sudah ditambahkan"
            ]);
        }

        try {
            DB::beginTransaction();

            foreach ($request->gejala as $value) {
                $set = [
                    "id" => Uuid::uuid4()->getHex(),
                    "id_penyakit" => $request->id_penyakit,
                    "id_gejala" => $value,
                ];

                $modul = BasisPengetahuan::create($set);

                if (!$modul->save()) {
                    throw new \Exception("Kesalahan dalam penyimpanan data");
                }
            }

            DB::commit();
            $msg = "Berhasil menambah data";

            return Redirect::to('basis_pengetahuan')->with([
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

    public function hapus(Request $request)
    {
        DB::beginTransaction();

        try {
            $basis = BasisPengetahuan::find($request->id);
            $data = BasisPengetahuan::where('id_penyakit', $basis->id_penyakit);

            if ($data->delete()) {
                DB::commit();
                return Redirect::to('basis_pengetahuan')->with([
                    'alert' => 1,
                    'message' => 'Berhasil menghapus data'
                ]);
            } else {
                return Redirect::to('basis_pengetahuan')->with([
                    'alert' => 0,
                    'message' => 'Gagal menghapus data'
                ]);
            }
        } catch (\Throwable $th) {
            return Redirect::to('basis_pengetahuan')->with([
                'alert' => 0,
                'message' => "Terjadi Kesalahan $th"
            ]);
        }
    }
}
