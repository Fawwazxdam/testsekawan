<?php

namespace App\Http\Controllers;

use App\Exports\SewaExport;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Sewa::all()->where('approval2',1);
        return view('admin.sewa',compact('data'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        Sewa::create($data);

        $result = Sewa::all();
        $result2 = $result->max('id');
        $detail = Sewa::find($result2);
        return view('detailsewa',compact('detail'));
        // return redirect('detailsewa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function show(Sewa $sewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sewa $sewa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sewa $sewa)
    {
        //
        $data = $request->all();
        $sewa->update($data);
        return redirect('sewa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sewa $sewa)
    {
        //
    }

    // FUNGSI MENYETUJUI
   public function approve(Sewa $sewa)
   {
       //
       $data = [
        'nama_cust' => $sewa->nama_cust, 
        'nohp' => $sewa->nohp, 
        'tanggal_sewa' => $sewa->tanggal_sewa, 
        'tanggal_kembali' => $sewa->tanggal_kembali, 
        'kendaraan_id' => $sewa->kendaraan_id, 
        'driver_id' => $sewa->driver_id, 
        'approval1' => $sewa->approval1, 
        'approval2' => 1, 
        'status' => 'onRent',
       ];
       $sewa->update($data);
       return redirect('approval');
   }

   //FUNGSI SELESAI PEMINJAMAN    
   public function selesai (Sewa $sewa)
   {
    $data = [
        'nama_cust' => $sewa->nama_cust, 
        'nohp' => $sewa->nohp, 
        'tanggal_sewa' => $sewa->tanggal_sewa, 
        'tanggal_kembali' => $sewa->tanggal_kembali, 
        'kendaraan_id' => $sewa->kendaraan_id, 
        'driver_id' => $sewa->driver_id, 
        'approval1' => $sewa->approval1, 
        'approval2' => $sewa->approval2, 
        'status' => 'Done',
       ];
       $sewa->update($data);
       return redirect('sewa');

   }

   public function export()
   {
    return Excel::download(new SewaExport, 'Rekap sewa.xlsx');
   }

}
