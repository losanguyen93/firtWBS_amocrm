<?php
$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/companies";
$headers[] = "Accept: application/json";
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
for ($i = 1; $i <= 100; $i++) {
    $data = array (
        'add' =>
            array (
                0 =>
                    array (
                        'name' => 'company'.$i,
                    ),
            ),
    );
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
    curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
    $out = curl_exec($curl);
    }
//Curl options
    curl_close($curl);
    $result = json_decode($out,TRUE);
?>

