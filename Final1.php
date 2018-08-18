<?php
function make_arraycompanies(){
    $data1 = array(
        array(
            'name' => 'ООО Компания' . strval(rand(1, 9999999)),
            'responsible_user_id' => 504141,
            'created_by' => 504141,
            'created_at' => '1533105060',
        ),
    );
    for ($i = 1; $i < 500; $i++) {
        $data_new =
            array(
                'name' => 'ООО Компания ' . strval(rand(1, 99999999)),
                'responsible_user_id' => 504141,
                'created_by' => 504141,
                'created_at' => '1533105060',
            );
        array_push($data1, $data_new);
    }
    $data['add']= $data1;
    return $data;
}
function make_arraycontacts(){
    $data1 = array(
        array(
            'name' => ' Контакт ' . strval(rand(1, 999999)),
            'responsible_user_id' => "2661781",
        ),
    );

    for ($i = 1; $i < 500; $i++) {
        $data_new =
            array(
                'name' => ' Контакт ' . strval(rand(1, 99999999)),
                'responsible_user_id' => "2661781",
            );
        array_push($data1, $data_new);
    }
    $data['add']= $data1;
    return $data;
}
function make_arrayleads($ids_frcont, $ids_frcom){
    $id_cont = explode(PHP_EOL, $ids_frcont);
    $id_com = explode(PHP_EOL, $ids_frcom);
    $data = array(
        array (
            'name' => 'Сделка номер ' . strval(rand(1, 99999999)),
            'company_id' => $id_com[1],
            'contacts_id' =>
                array (
                    0 => $id_cont[1],
                ),
        ),
    );
    for ($i = 1; $i < 500; $i++) {
        $data_new =
            array (
                'name' => 'Сделка номер '. strval(rand(1, 9999999)),
                'company_id' => $id_com[$i+1],
                'contacts_id' =>
                    array (
                        0 => $id_cont[$i+1],
                    ),
            );
        array_push($data, $data_new);
    }
    $data_new2['add']= $data;
    return $data_new2;
}
function send_data($data, $type){
    if ($type == 'companies') $link = "https://losalinh.amocrm.ru/api/v2/companies";
    if ($type == 'contacts') $link = "https://losalinh.amocrm.ru/api/v2/contacts";
    if ($type == 'leads') $link = "https://losalinh.amocrm.ru/api/v2/leads";
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
    curl_close($curl);
    if ($type == 'companies' || $type == 'contacts'){
        $Response=json_decode($out,true);
        $Response=$Response['_embedded']['items'];
        $output='ID добавленных контактов:'.PHP_EOL;
        foreach($Response as $v){
            if(is_array($v)) $output.=$v['id'].PHP_EOL;
        }
        return $output;
    }
    else{
        $Response=json_decode($out,true);
        return $Response;
    }
}
function make_requestdata($ids_frcont)
{
    $id_cont = explode(PHP_EOL, $ids_frcont);
    $datak = array(
                array(
                    "id" => $id_cont[1],
                    "updated_at" => 1534507560,
                    "custom_fields" => [
                                        [

                                            "id" => 343317,     // id поля
                                            "values" =>[
                                                [
                                                    "values" => "+7(98".strval(rand(1, 9)).")".strval(rand(1000000, 9999999)) //Поле типа текст
                                                ]

                                            ]


                                        ],
                    ]
                )
             );
    for ($i = 2; $i <= 500; $i++){
        $datal = array(
            "id" => $id_cont[$i],
            "updated_at" => 1534507560,
            "custom_fields" => [
                [
                    "id" => 345631,     // id поля
                    "values" => [
                        [
                        "value" => "+7(98".strval(rand(1, 9)).")".strval(rand(1000000, 9999999)) //Поле типа текст
                        ]
                    ]
                ],
            ]
        );
        array_push($datak, $datal);
    };
    $data['update'] = $datak;
    return $data;
}


for ($i = 1; $i <= 2; $i++) {
    $result1 = send_data(make_arraycontacts(), 'contacts');
    $result2 = send_data(make_arraycompanies(), 'companies');
    send_data(make_arrayleads($result1, $result2), 'leads');
    $result3 = send_data(make_requestdata($result1), 'contacts');
    print_r($result3);
}
?>