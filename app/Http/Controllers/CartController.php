<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id_user = Auth::id();
        $id_barang = request('id');
        $data_fetch = DB::select("SELECT * FROM carts WHERE id_user= $id_user and id_barang= $id_barang;");


        if(count($data_fetch)==0){
            $data = [
                'id_user' => $id_user,
                'id_barang' => $id_barang,
                'jumlah' => 1,
                'total_harga' => (int)DB::select("SELECT harga FROM produks WHERE id= $id_barang;")[0]->harga
            ];
            Cart::insert($data);
        }
        else{

            $cartID = (int)DB::select("SELECT id FROM carts WHERE id_barang= $id_barang AND id_user = $id_user;")[0]->id;
            

            // dd($cartID);

            $jmlhBrg = ((int)DB::select("SELECT jumlah FROM carts WHERE id_barang= $id_barang AND id_user = $id_user;")[0]->jumlah) + 1;

            $data = [
                'jumlah' => $jmlhBrg,
                'total_harga' => ((int)DB::select("SELECT harga FROM produks WHERE id= $id_barang;")[0]->harga) * $jmlhBrg
            ];

            Cart::find($cartID)->update($data);
        }


        // dd($data_fetch);

        return redirect()->intended('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id_user = Auth::id();
        $cart = DB::select("SELECT * FROM carts WHERE id_user = $id_user;");


        // dd($cart);
        return view("cart", ['title' => 'Cart', 'cart'=>$cart]);
    }

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
    public function destroy()
    {
        $id = request('id');
        Cart::find($id)->delete();

        return back();
    }
}
