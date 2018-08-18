<?php
$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/contacts";
$headers[] = "Accept: application/json";
//Curl options
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
                        'name' => $i,
                        'responsible_user_id' => '2661781',
                        'custom_fields' =>
                            array (
                                0 =>
                                    array (
                                        'id' => '333549',
                                        'values' =>
                                            array (
                                                0 =>
                                                    array (
                                                        'value' => "+7(98".strval(rand(1, 9)).")".strval(rand(1000000, 9999999)),
                                                        'enum' => 'WORK',
                                                    ),
                                            ),
                                    ),
                            ),
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

curl_close($curl);
$result = json_decode($out,TRUE);
print_r($result);

?>