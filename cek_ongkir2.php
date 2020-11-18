<?php
$asal = 209;
$id_kabupaten = $_POST['kab_id'];
$kurir = $_POST['kurir'];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=" . $asal . "&destination=" . $id_kabupaten . "&weight=10000&courier=" . $kurir . "",
    CURLOPT_HTTPHEADER => array(
        'content-type: application/x-www-form-urlencoded',
        'key: fddeab3d6d3e203bb4c1f16f74c6e6c0'
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
$nilai = json_decode($response, true);
$k = 0;
$i = 1;
// $i = count($nilai['rajaongkir']['results'][$k]['costs']);
// $data = $nilai['rajaongkir']['results'][$k]['costs'][1]['cost'][0]['value'];

$ongkir = $nilai['rajaongkir']['results'][$k]['costs'][$i]['cost'][$k]['value'];
$hg_total  = $ongkir + 260000;
$data = array(
    'hg_total' => $hg_total,
    'ongkir' => $ongkir
);

// echo $hg_total;
echo $ongkir;
