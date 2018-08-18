<?php
//$data_all = array();
//$data = array (
//    'add' =>
//        array (
//            0 =>
//                array (
//                    'name' => 'company'.'1',
//                ),
//        ),
//);
//
//for ($i = 1; $i <= 10; $i++){
//    array_push($data_all, $data);
//}
//print_r($data_all);
//$data['add']=array(
//    array(
//        'name' => 'ООО Компания'.'11',
//        'responsible_user_id' => 504141,
//        'created_by' => 504141,
//        'created_at' => '1533105060',
//    ),
//    array(
//        'name' => 'ООО Компания'.'12',
//        'responsible_user_id' => 504141,
//        'created_by' => 504141,
//        'created_at' => '1533105060',
//    )
//);
$data1 = array(
    array(
        'name' => 'ООО Компания' . '0',
        'responsible_user_id' => 504141,
        'created_by' => 504141,
        'created_at' => '1533105060',
    ),
);

for ($i = 1; $i <= 5; $i++) {
    $data_new =
        array(
            'name' => 'ООО Компания' . $i,
            'responsible_user_id' => 504141,
            'created_by' => 504141,
            'created_at' => '1533105060',
        );
    array_push($data1, $data_new);
}
$data['add']= $data1;
print_r($data);


$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/companies";
$headers[] = "Accept: application/json";
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
$out = curl_exec($curl);
//Curl options
curl_close($curl);
$result = json_decode($out,TRUE);
print_r($result);
?>



