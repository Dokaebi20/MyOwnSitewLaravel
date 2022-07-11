@extends('layouts.main')
@section('container')
<style>
    .container{
        width: 100vw;
        padding: 5vw;
        text-align: center;
    }
    .container.table th{
        margin: auto;
    }
</style>
<div class="container">
    @if(count($cart)!=0)
    <table class="table">
        
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col">Tambah</th>
            <th scope="col">Hapus</th>
          </tr>
        </thead>
        <tbody>
        <?php
         $countCart = 1;
         $countTotalHarga = 0;
         ?>

        @foreach($cart as $c)
          <tr>
            <th class="align-middle" scope="row"><?php echo  $countCart++?></th>
            <td class="align-middle"><img src="../img/product/{{DB::select("SELECT link_img FROM produks WHERE id = $c->id_barang")[0]->link_img}}" width="40vw"></td>
            <td class="align-middle">{{DB::select("SELECT nama_barang FROM produks WHERE id = $c->id_barang")[0]->nama_barang}}</td>
            <td class="align-middle">{{$c->jumlah}}</td>
            <td class="align-middle">Rp {{number_format($c->total_harga)}}</td>
            <?php  $countTotalHarga += $c->total_harga?>
            <td class="align-middle"><a href="/addtocart?id={{$c->id_barang}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
              </svg></a>
            <td class="align-middle"><a href="/delfromcart?id={{$c->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
              </svg></a></td>
          </tr>
          @endforeach
          @if(( $c == end($cart)))
          <th scope="row" colspan="4" class="align-middle"> TOTAL HARGA</th>
          <td colspan="3">Rp <?php echo number_format($countTotalHarga) ?></td>
          @endif
        </tbody>
      </table>
      <a href="/checkout"><button type="button" class="btn btn-success">Check Out</button></a>
@else
    <h1 class="align-middle">Cart Anda Kosong!</h1>
@endif
</div>
@endsection