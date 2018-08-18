<?php
#Массив с параметрами, которые нужно передать методом POST к API системы
$user=array(
// 'USER_LOGIN'=>'znguen@team.amocrm.com', #Ваш логин (электронная почта)
// 'USER_HASH'=>'d6362c792b8e50f934c5b320d1fcf0da79782fc7' #Хэш для доступа к API (смотрите в профиле пользователя)

 'USER_LOGIN'=>'losa_linh@mail.ru', #Ваш логин (электронная почта)
 'USER_HASH'=>'483e591287953508e1aafe4c7424483ddf8de1ed' #Хэш для доступа к API (смотрите в профиле пользователя)
);
//$subdomain='znguen.vlaptev'; #Наш аккаунт - поддомен
//#Формируем ссылку для запроса
//$link= $subdomain.'.amocrm2.com/private/api/auth.php?type=json';

$link = "https://losalinh.amocrm.ru/private/api/auth.php?type=json";
/* Нам необходимо инициировать запрос к серверу. Воспользуемся библиотекой cURL (поставляется в составе PHP). Вы также
можете
использовать и кроссплатформенную программу cURL, если вы не программируете на PHP. */
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
curl_close($curl); #Завершаем сеанс cURL
/* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
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
 if($code!=200 && $code!=204)
    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code); /*разве в скобке не должна быть строка? */
}
catch(Exception $E)
{
  die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}
/*
 Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 нам придётся перевести ответ в формат, понятный PHP
 */
echo $out;
$Response=json_decode($out,true);

//echo string implode ( ",",$Response );
$Response=$Response['response'];
print_r ($Response);
if(isset($Response['auth'])) #Флаг авторизации доступен в свойстве "auth"
 echo '   ok norm';
 return 'Авторизация прошла успешно';


echo 'Нет взошла';
return 'Авторизация не удалась';




?>