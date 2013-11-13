<?php

class mailerController extends CController
{
	
	public function actionIndex()
	{
		
		$message = new YiiMailMessage;
		$message->view = 'contactForm';
		//$message->setBody('Message content here with HTML', 'text/html');
		$message->setBody(array('name'=>$name,
								'mail'=>$mail), 'text/html');
		$message->subject = 'My Subject';
		$message->addTo('mh.saadatfar@gmail.com');
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}
	
}
