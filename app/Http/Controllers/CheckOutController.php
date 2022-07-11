<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckOut;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $hargaBarang = Cart::where('id_user',$id)->sum('total_harga');
        $beratBarang = Cart::where('id_user',$id)->sum('jumlah') * 5;

        return view("checkout",[
            'title' => 'Check Out',
            'hargaBarang' => number_format($hargaBarang),
            'beratBarang' => $beratBarang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        $city = request()->get('city');
        $id = Auth::id();
        $hargaBarang = Cart::where('id_user',$id)->sum('total_harga');
        $beratBarang = Cart::where('id_user',$id)->sum('jumlah') * 5;

        return view("checkout",[
            'title' => 'Check Out',
            'hargaBarang' => number_format($hargaBarang),
            'beratBarang' => $beratBarang,
            'city' => $city
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $id = Auth::id();
        $dateTime = date('Y-m-d H:i:s');
        $hargaBarang = Cart::where('id_user',$id)->sum('total_harga');
        $biayaOngkir = request()->get('biayaOngkir');
        
        CheckOut::create([
            'id_user' => $id,
            'harga_barang' => $hargaBarang,
            'total_biaya' => $hargaBarang+$biayaOngkir,
            'tanggal' => $dateTime,
            'biaya_ongkir' => $biayaOngkir
        ]);

        Cart::where('id_user', $id)->delete();

        return back()->with('paymentSuccess', 'Pembayaran Berhasil!');




        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
