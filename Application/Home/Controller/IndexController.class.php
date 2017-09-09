<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		header("Location: /Admin");
		$huge = new \Huge\Test();
		echo $huge->sayHello();
	}
	
	public function huge(){
		$c1 = C("HUGE.USER_NAME");
		$c2 = C("HUGE.USER_ID");
		echo $c1."-".$c2;
	}
}