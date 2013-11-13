<?php
$message = new YiiMailMessage;
$message->view = 'contactForm';
//$message->setBody('Message content here with HTML', 'text/html');
$message->setBody(array('name'=>$name,
		'email'=>$email), 'text/html');
$message->subject = 'My Subject';
$message->addTo(Yii::app()->params['AdminMail']);
$message->from = 'info@tiraxnet.ir';
Yii::app()->mail->send($message);