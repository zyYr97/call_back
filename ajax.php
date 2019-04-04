<?
require __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/vendor/phpmailer/phpmailer/src/SMTP.php';
if($_POST['fio'] and $_POST['phone']){
	if(substr($_POST['email'], strrpos($_POST['email'], '@')) != '@gmail.com'){
		$message = ' 
		<html> 
		    <head> 
		        <title>Заполнена форма обратной связи</title> 
		    </head> 
		    <body> 
		        <p>ФИО: '.$_POST['fio'].'</p>
		        <p>Адрес: '.$_POST['adress'].'</p>
		        <p>Email: '.$_POST['email'].'</p>
		        <p>Мобильный телефон: '.$_POST['phone'].'</p>
		        <p>Комментарий: '.$_POST['comment'].'</p>
		    </body> 
		</html>';
		$mail = new PHPMailer;
		$logger = new Logger('mail');
		$logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());
		$logger->info(print_r($_POST, true));
		$mail->setFrom('zyyr97@yandex.com');      
		$mail->addAddress('zyyr97@gmail.com');
		$mail->msgHTML($message);
		$mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);     
		if(!$mail->Send()){
			$error[] = $mail->ErrorInfo;
		}
		echo 'Форма успешна отправлена!';
	} else {
		echo 'Регистрация пользователя с таким почтовым адресом невозможна';
	}
} else {
	echo 'Поля ФИО и Мобильный телефон обязательны для заполнения';
}
?>