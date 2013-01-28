<?php
class Admin{
	public static function Menu($c){
		return AdminMenu::Render($c);
	}
}