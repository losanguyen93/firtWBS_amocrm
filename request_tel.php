<?php
$link = "https://bvcbnvcbvcb.amocrm.ru/api/v2/contacts";
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
curl_close($curl);
$code=(int)$code;
$errors=array(
301=>'Moved permanently',
400=>'Bad request',
401=>'Unauthorized',
403=>'Forbidden',
404=>'Not found',
500=>'Internal server error',
502=>'Bad gateway',
503=>'Service unavailable'
);
try
{
#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
if($code!=200 && $code!=204) {
throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
}
catch(Exception $E)
{
die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}
/*
Данные получаем в формате JSON, поэтому, для получения читаемых данных,
нам придётся перевести ответ в формат, понятный PHP
*/
$Response=json_decode($out,true);
$Response=$Response['_embedded']['items'];
//print_r($Response);
foreach($Response as $x=>$x_value)
{
    foreach($x_value as $p=>$p_value)
    {
        if ($p == 'custom_fields'){
            foreach($p_value as $p1=>$p1_value){
                foreach ($p1_value as $p2=>$p2_value){
                    if ($p2 == 'values'){
                        foreach ($p2_value as $p3=>$p3_value){
                            foreach ($p3_value as $p4=>$p4_value) {
                                if ($p4 == 'value') {
                                    print_r($p4_value);
                                    echo "\n";
                                }
                            }

                        }
                    }
                }

            }
        }
    }
}




?>