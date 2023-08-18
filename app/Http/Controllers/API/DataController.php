<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class DataController extends ApiController
{
    public function gejala()
    {
        try {
            $data = Gejala::orderBy("kode_gejala")->get();

            return $this->sendSuccess("Berhasil mendapatkan data", $data, 200);
        } catch (\Throwable $th) {
            $this->sendError("gagal mendapatkan data gejala", $th->getMessage(), 500);
        }
    }

    public function get_penyakit(Request $request)
    {
        try {
            $data = Gejala::whereIn("id", $request->gejala)->get();
            foreach ($data as $key => $value) {
                $gejala[] = $value->kode_gejala;
            }

            foreach ($data as $key => $value) {
                $G[$key] = $value->nilai_densitas;
                $Go[$key] = round(1 - floatval($G[$key]), 2);
            }

            $perkalianG = 0;
            $penjumlahanG = 0;
            foreach ($G as $key => $value) {
                if ($key == 0) {
                    $perkalianG = $G[$key];
                } else {
                    $perkalianG = $perkalianG * $G[$key];
                }

                $penjumlahanG += ((1 - floatval($value)) * floatval($value));
            }

            $perkalianG = round($perkalianG, 2);
            $penjumlahanG = round($penjumlahanG, 2);
            $persentase = $perkalianG + $penjumlahanG;

            $arrayPenyakit = array("P01", "P02", "P03", "P04");
            $penyakit = Penyakit::where('kode_penyakit', $arrayPenyakit[rand(0, 3)])->get()->first();

            if (in_array("G01", $gejala) && in_array("G02", $gejala)) {
                $penyakit = Penyakit::where('kode_penyakit', "P01")->get()->first();

            }

            if (in_array("G03", $gejala) && in_array("G04", $gejala)) {
                $penyakit = Penyakit::where('kode_penyakit', "P02")->get()->first();
            }

            if (in_array("G05", $gejala) && in_array("G06", $gejala) && in_array("G07", $gejala)) {
                $penyakit = Penyakit::where('kode_penyakit', "P03")->get()->first();
            }

            if (in_array("G08", $gejala) && in_array("G09", $gejala) && in_array("G10", $gejala) && in_array("G11", $gejala)) {
                $penyakit = Penyakit::where('kode_penyakit', "P04")->get()->first();
            }

            $getdata = [
                "persentase" => ($persentase * 100)."%",
                "penyakit" => $penyakit->nama_penyakit,
                "saran" => $penyakit->solusi
            ];


            return $this->sendSuccess("Berhasil mendapatkan data", $getdata, 200);
        } catch (\Throwable $th) {
            $this->sendError("Gagal mendapatkan penyakit", $th->getMessage(), 500);
        }
    }
}
