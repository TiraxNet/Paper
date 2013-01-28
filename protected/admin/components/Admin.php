<?php
class Admin{
	public function Menu($c){
		return AdminMenu::Render($c);
	}
}