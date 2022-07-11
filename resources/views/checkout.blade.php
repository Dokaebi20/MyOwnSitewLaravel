@extends('layouts.main')
@section('container')
<?php
$curl_1 = curl_init();

curl_setopt_array($curl_1, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 32b0e46cdf5f104aa95c531792beed97"
  ),
));

$response_1 = curl_exec($curl_1);
$err_1= curl_error($curl_1);

curl_close($curl_1);

if ($err_1) {
  echo "curl_1 Error #:" . $err_1;
} else {
  $array_res_1 = json_decode($response_1);
  $resProv_1 = $array_res_1->rajaongkir->results;
}

?>
<style type="text/css">
    .main_container{
        width: 100vw;
        padding: 7.5%;
    }
    .main_container .alert{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    .main_container h1{
        text-align: center;
    }
    .container_1 label{
        font-size: 20px
    }
    .container_1 .form-check{
        margin-bottom: 1vh;
    }
    .container_2{
        width: 20%;
    }
    .container_3{
        margin-top: 2.5%;
    }
</style>
@if(session()->has('paymentSuccess'))
<div class="main_container">
    <div class="alert alert-success" role="alert">{{session()->get('paymentSuccess')}}</div>
</div>
@elseif($hargaBarang == 0)
<div class="main_container">
    <h1 class="align-middle">Check Out Anda Kosong!</h1>
</div>
@else

<script>
     <?php
        $curl_2 = curl_init();

        $city = request()->has('city') ?  request()->get('city') : '' ;

        $fieldpost = $city!= ''?"origin=399&destination=".$city."&weight=".($beratBarang*1000)."&courier=jne" : "origin=399&destination=3&weight=".$beratBarang."&courier=jne";

        curl_setopt_array($curl_2, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $fieldpost,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 32b0e46cdf5f104aa95c531792beed97"
        ),
        ));

        $response_2 = curl_exec($curl_2);
        $response_2_1 = json_decode( $response_2);
        $err_2 = curl_error($curl_2);

        curl_close($curl_2);

        if ($err_2) {
        echo "curl_2 Error #:" . $err_2;
        } else {
         $biayaOngkir =$response_2_1->rajaongkir->results[0]->costs[0]->cost[0]->value;
        }
        ?>
    $(document).ready(function(){


        @if(isset($city))
            $('#city').val({{$city}});
        @endif
        console.log($('#city').val());
        console.log(<?php echo number_format($beratBarang)?>);
        console.log(<?php  echo $city == '' ?  "" :  number_format($city);?>);

        if($('#city').val() != "--Select City--"){
            $('.td-4-right').html("<?php echo 'Rp'.number_format($biayaOngkir)?>");
            $('.btn').click(function(){
                document.getElementById("form-pengiriman-2").submit();
            }
            )
        }
        else{
            $('.btn').prop('disabled', true);
        }
        $('#city').change(function(){

            if($('#city').val() != "--Select City--"){
                document.getElementById("form-pengiriman").submit();
            }
            else{
                $('.td-4-right').html('');
                console.log($('#city').val());
            }
        })
    });
   
</script>
<div class="main_container">
    <div class="container_1">
        <h3>PEMBAYARAN</h3>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2" value = "BCAVirtualAccount" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                BCA Virtual Account
            </label>
        </div>
        <div class="form-check align-middle">
            <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="">
            <label class="form-check-label" for="flexRadioDefault1">
              Mandiri E-Banking
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="GoPay">
            <label class="form-check-label" for="flexRadioDefault1">
                Go-Pay
            </label>
        </div>
    </div>
    <div class="container_2">
        <h3>Ekspedisi Via JNE </h3>
        <form id="form-pengiriman" action="/checkout" method="POST" >
            @csrf
            <input name="biayaOngkir" value="<?php echo $biayaOngkir;?>" style="visibility: hidden;"></input>
        <select class="form-select mb-3" aria-label="Default select example" name="city" id="city">
            <div class="form-select-option-place">
                <option value="--Select City--" selected>--Select City--</option>
                <?php foreach($resProv_1 as $rp): ?>
                <option value = <?php echo $rp->city_id ?>><?php echo $rp->type." ".$rp->city_name;?></option>
                <?php endforeach; ?>
            </div>
        </select>
    </form>
        <form id="form-pengiriman-2" action="/checkout/accept" method="POST" style="visibility: hidden">
            @csrf
            <input name="biayaOngkir" value="<?php echo $biayaOngkir;?>" style="visibility: hidden;"></input>
        <select style="visibility: hidden" class="form-select mb-3" aria-label="Default select example" name="city" id="city">
            <div class="form-select-option-place">
                <option value="--Select City--" selected>--Select City--</option>
                <?php foreach($resProv_1 as $rp): ?>
                <option value = <?php echo $rp->city_id ?>><?php echo $rp->type." ".$rp->city_name;?></option>
                <?php endforeach; ?>
            </div>
        </select>
        </form>
    </div>
    <div class="container_3">
        <table class="table">
            <tbody>
                <thead>
                    <tr>
                      <th scope="col"> </th>
                      <th scope="col"> </th>
                    </tr>
                </thead>
              <tr>
                <td scope="row">Harga Barang</th>
                <td style="text-align: end">
                    Rp 
                    {{
                        $hargaBarang;
                    }}
                </td>
              </tr>
              <tr>
                <td scope="row">Biaya Ongkir</th>
                <td class="td-4-right" style="text-align: end">
                   </td>
              </tr>
            </tbody>
          </table>
            <button type="button" class="btn btn-success" style="margin: auto">Accept</button>
    </div>
</div>

@endif
@endsection