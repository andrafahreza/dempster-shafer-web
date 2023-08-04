<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

class DataController extends ApiController
{
    public function gejala()
    {
        try {
            $data = Gejala::get();

            return $this->sendSuccess("Berhasil mendapatkan data", $data, 200);
        } catch (\Throwable $th) {
            $this->sendError("gagal mendapatkan data gejala", $th->getMessage(), 500);
        }
    }
}
