<?
// Принимаем данные с формы
$name			=stripcslashes($_POST['name']);
$email			=stripcslashes($_POST['email']);
$phone			=stripcslashes($_POST['custom_Phone_invalid']);
$comment		=stripcslashes($_POST['comment']);
$referrer		=stripcslashes($_POST['referrer']);
$order_url		=stripcslashes($_POST['order_url']);
$transaction_id	=stripcslashes($_POST['transaction_id']);
$partner_id		=stripcslashes($_POST['partner_id']);
$link_id		=stripcslashes($_POST['link_id']);
$product_id		=stripcslashes($_POST['product_id']);
$result_url		=stripcslashes($_POST['result_url']);

if ($result_url == ""){
	$result_url = "http://crm.botsmansergey.pp.ua/success-page/";
};

//if ($phone == "" || $email == ""){
//	exit("не переданы личные данные");
//};

// Отправляем данные в ЦРМ
// массив для переменных, которые будут переданы с запросом
$paramsArray = array(
	'name'				=>	$name,
	'email'				=>	$email,
	'phone'				=>	$phone,
	'comment'			=>	$comment,
	'referrer'			=>	$referrer,
	'order_url'			=>	$order_url,
	'transaction_id'	=>	$transaction_id,
	'partner_id'		=>	$partner_id,
	'link_id'			=>	$link_id,
	'product_id'		=>	$product_id
);
$vars = http_build_query($paramsArray); // преобразуем массив в URL-кодированную строку
$options = array( // создаем параметры контекста
	'http' => array(
				'method'  => 'POST',  // метод передачи данных
				'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок
				'content' => $vars,  // переменные
			) 
);
$context  = stream_context_create($options);  // создаём контекст потока
$result = file_get_contents('http://cc.salesup-crm.com/PostOrder.aspx', false, $context); //отправляем запрос

/*var_dump($result); // вывод результата
echo $result;*/

header( 'Refresh: 0; url='.$result_url );

// Выводим сообщение пользователю
print "
<!DOCTYPE html>
<html lang=\"ru\">

<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\"/>
<head>
	<meta charset=\"utf-8\"/>
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
	<title></title>
</head>
<body>
	
</body>
</html>
";
exit;
?>