<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Http\Requests\StoreResepRequest;
use App\Http\Requests\UpdateResepRequest;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reseps = Resep::with('detailResep')->orderBy('created_date','DESC')->get();
        return response()->json($reseps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResepRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResepRequest $request)
    {
        //membuat resep baru dan mengambil data model resep
        $resep = Resep::create([
            'resep_kode' =>  $request->resep_kode,
            'patient' =>  $request->patient,
            'doctor' => $request->doctor,
            'poli' => $request->poli,
        ]);

        //mengambil objek detail resep dari list request
        $detailReseps = $request->detailResep;

        //jika detail resep tidak kosong maka menyimpan data detail resep baru
        if($detailReseps != null){
            //melooping ada berapa jenis detail dalam satu resep
            foreach ($detailReseps as $detailResep) {
                //menyimpan detail resep baru dg data id resep,id signa, jenis racikan (racikan/non) dan nama racikan
                $savedDetailResep = $resep->detailResep()->create([
                    'resep_id' => $resep->id,
                    'signa_id' => $detailResep->signa_id,
                    'jenis_racikan' => $detailResep->jenis_racikan,
                    'nama_racikan' => $detailResep->nama_racikan,
                ]);
                //setiap detail resep akan menyimpan detail racikan (jika non racikan hanya akan loop 1 baris untuk menyimpan nama dan quantity obat, jika racikan maka akan loop sebanyak jumlah obatnya)
                $detailRacikans = $request->detailRacikan;
                if($detailRacikans != null){
                    foreach ($detailRacikans as $detailRacikan) {
                        //menyimpan data detail racikan perline/per-obat-nya
                        $savedDetailResep->detailRacikan()->create([
                            'obatalkes_id' => $detailRacikan->obatalkes_id,
                            'detailresep_id' => $savedDetailResep->id,
                            'quantity' => $detailRacikan->quantity,
                        ]);
                        //mengubah stok yg ada di tabel obat dikurangi jumlah obat dlm resep
                        $obat = Obatalkes::findOrFail($detailRacikan->obatalkes_id);
                        $obat->update(['stok'=> ($obat->stok - $detailRacikan->quantity),]);
                        $obat->save();
                    }
                }
            }
        }

        return $resep;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $resep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit(Resep $resep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResepRequest  $request
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResepRequest $request, Resep $resep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resep $resep)
    {
        //
    }
}