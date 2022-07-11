@extends('layouts.main')
@section('container')
<style type="text/css">
.container_1{
    width: 100vw;
    height: 50vh;
    display: block;
    padding-top: 3%;
    text-align: center;
    color: rgb(25, 135, 84);
}
.container_1 h1{
    font-weight: bold;
}
.container_1 img{
    width: 35wh;
    height: 25vh;
    vertical-align: middle;
    margin-left: auto;
    margin-bottom: auto;
}

.card img{
    width: 150px;
    height: 450px;
}

.row{
    width: 100vw;
    padding-left: 10vw;
    padding-right: 10vw;
    display: flex;
}
.row .card{
    width : 20vw;
    margin-left: 3vw;
    margin-right: 3vw;
    margin-bottom: 5vh;
    box-shadow: 5px 10px 18px #888888;
}
.row .card img{
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    
}
    
</style>
<div class="container_1">
    <img src="../img/main_img/iconABC.png" alt="iconABC">
    <h1>Toko Musik Online No. 1</h1>
</div>
<?php $counter_=0?>
@foreach($produk as $p)

@if($counter_%3==0)
<div class="row">
@endif
    <div class="card" >
        <img class="card-img-top" src="../img/product/{{$p['link_img']}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$p['nama_barang']}}</h5>
          <p class="card-text">Rp {{number_format($p['harga'])}}</p>
          <a href="/addtocart?id={{$p['id']}}"><button class="btn btn-primary">
            Add to Cart+
          </button></a>
        </div>
    </div>

@if($counter_%3==2)
</div>
@endif



<?php $counter_++?>

@endforeach

@endsection