<?php
$message = new YiiMailMessage;
$message->view = 'contactForm';
//$message->setBody('Message content here with HTML', 'text/html');
$message->setBody(array('name'=>$name,
		'email'=>$email,
		'subject'=>$subject,
		'body'=>$body), 'text/html');
$message->subject = 'New Contact From Your Website: '.$subject;
$message->addTo(Yii::app()->params['AdminMail']);
$message->from = 'info@tiraxnet.ir';
Yii::app()->mail->send($message);