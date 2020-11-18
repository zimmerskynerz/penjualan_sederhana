<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/city?",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: fddeab3d6d3e203bb4c1f16f74c6e6c0"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$kota = json_decode($response, true);
echo '<pre>';

var_dump($kota);
die;

foreach ($kota as $Kota) :
    echo $Kota['rajaongkir']['results']['1']['city_id'];
endforeach;
