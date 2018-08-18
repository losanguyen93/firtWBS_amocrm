<?php
//$data['add'] = array (
//    array(
//        "custom_fields"=>[
//            [
//                "id"=>333549,     // id поля
//                "values"=> "791112345"
//
//            ]
//        ]
//    ),
//);
$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/fields";

//{
//    update: [
//      {
//          id: "41560",
//         updated_at: "1508965200",
//         custom_fields: [
//            {
//                id: "4396819",
//               values: [
//                  {
//                      value: "example@example.moc",
//                     enum: "WORK"
//                  }
//               ]
//            }
//         ]
//      }
//   ]
//}




$data['update'] = array(
    array(
        "id" => 12278797,
        "updated_at" => 1534507560,
        "custom_fields"=>[
            [
                "id"=>343317,     // id поля
                "values"=> [
                    [
                        "value"=>"791123121315" //Поле типа текст
                    ]

                ]
            ],
        ]
    ),
    array(
        "id" => 12278799,
        "updated_at" => 1534507560,
        "custom_fields"=>[
            [
                "id"=>343317,     // id поля
                "values"=> [
                    [
                        "value"=>"791123121315" //Поле типа текст
                    ]

                ]
            ],
        ]
    )
);

$headers[] = "Accept: application/json";
//$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/fields";
$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/contacts";
//Curl options
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
curl_close($curl);
$result = json_decode($out,TRUE);
print_r($result);
?>