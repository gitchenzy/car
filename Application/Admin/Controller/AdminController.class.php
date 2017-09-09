<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AuthRuleModel;

class AdminController extends Controller {
	/* 保存禁止通过url访问的公共方法,例如定义在控制器中的工具方法 ;deny优先级高于allow*/
	static protected $deny  = array('getMenus');

	/* 保存允许访问的公共方法 */
	static protected $allow = array( 'login','logout');

	/* 保存只要登录都允许访问的公共方法 */
	static protected $allow_login = array();

	protected $admin_authoried = true;
	protected function _initialize(){
		$user = get_user();
		if ($this->admin_authoried && empty($user)) {
			redirect("/admin/account/Login");
		}

		$this->assign("user" , $user);
		$config = M("config")->select();
		if ($config!==false) {
			foreach($config as $k => $v) {
				C($k , $v);
			}
		}

		//当前登录用户是否根用户
		$is_root = 0;
		if ($user && strtolower($user['EmployeeNum']) == 'admin') {
			$is_root = 1;
		}
		$this->is_root = $is_root;

		// 检测访问权限
		$access =   $this->accessControl();
		if ( $access === false ) {
			$this->error('403:禁止访问');
		}elseif( $access === null ){
			$dynamic        =   $this->checkDynamic();//检测分类栏目有关的各项动态权限
			if( $dynamic === null ){
				//检测非动态权限
				$rule  = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
				//dump($this->checkRule($rule,array('in','0,1,2')));
				if ( !$this->checkRule($rule,array('in','0,1,2')) ){
					$this->error('提示:无权访问,您可能需要联系管理员为您授权!' , '/admin/account/login');
				}
			}elseif( $dynamic === false ){
				$this->error('提示:无权访问,您可能需要联系管理员为您授权!' , '/admin/account/login');
			}
		}
		if($user['EmployeeNum'] == 'admin'){
			$map=array(
				'ShowType'=>0,
				'status'=>1,
			);
			$menu = M('menu') -> where($map)-> order('Sort') -> select();
			$menu = Employee($menu ,0);
		}else{
			$menu = get_Menu();
		}

		//dump(display_menu('/admin/Market/delContract'));
		//$Auth       =   new \Think\Auth2();
	//	$result = $Auth -> check($rule, get_user_id() ,array('in','0,1,2'),get_user_type(),'url');
	//	dump($result);
		$this->user = get_user();
		$this->top_tag = "index";
		$this->sub_tag = "index.index";
		$this->assign("self", __SELF__);
		$this->assign("menu", $menu);
	}



	/**
	 * 权限检测
	 * @param string  $rule    检测的规则
	 * @param string  $mode    check模式
	 * @return boolean
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
	final protected function checkRule($rule, $type=AuthRuleModel::RULE_URL, $mode='url'){

		if($this->is_root){
			return true;//管理员允许访问任何页面
		}
		static $Auth    =   null;
		if (!$Auth) {
			$Auth       =   new \Think\Auth2();
		}
		if(!$Auth->check($rule, get_user_id() ,$type,get_user_type(),$mode)){
			return false;
		}
		return true;
	}



	/**
	 * 检测是否是需要动态判断的权限
	 * @return boolean|null
	 *      返回true则表示当前访问有权限
	 *      返回false则表示当前访问无权限
	 *      返回null，则会进入checkRule根据节点授权判断权限
	 *
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
	protected function checkDynamic(){
		if($this->is_root){
			return true;//管理员允许访问任何页面
		}
		return null;//不明,需checkRule
	}

	/**
	 * action访问控制,在 **登陆成功** 后执行的第一项权限检测任务
	 *
	 * @return boolean|null  返回值必须使用 `===` 进行判断
	 *
	 *   返回 **false**, 不允许任何人访问(超管除外)
	 *   返回 **true**, 允许任何管理员访问,无需执行节点权限检测
	 *   返回 **null**, 需要继续执行节点权限检测决定是否允许访问
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
	final protected function accessControl(){
		if($this->is_root){
			return true;//管理员允许访问任何页面
		}
		$controller = 'Admin\\Controller\\'.CONTROLLER_NAME.'Controller';
		if ( !is_array($controller::$deny)||!is_array($controller::$allow) ){
			$this->error("内部错误:{$controller}控制器 deny和allow属性必须为数组");
		}
		$deny  = $this->getDeny();
		$allow = $this->getAllow();
		$allow_login = $this->getAllowLogin();
		if ( !empty($deny)  && in_array(ACTION_NAME,$deny) ) {
			return false;//非超管禁止访问deny中的方法
		}
		if ( !empty($allow) && in_array(ACTION_NAME,$allow) ) {
			return true;
		}
		if (!empty($allow_login) && in_array(ACTION_NAME,$allow_login) && $this->user) {
			return true;
		}
		return null;//需要检测节点权限
	}


	/**
	 * 获取控制器中允许禁止任何人(超管除外)通过url访问的方法
	 * @param  string  $controller   控制器类名(不含命名空间)
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
	final static protected function getDeny($controller=CONTROLLER_NAME){
		$controller =   'Admin\\Controller\\'.$controller.'Controller';
		$data       =   array();
		if ( is_array( $controller::$deny) ) {
			$deny   =   array_merge( $controller::$deny, self::$deny );
			foreach ( $deny as $key => $value){
				if ( is_numeric($key) ){
					$data[] = strtolower($value);
				}else{
					//可扩展
				}
			}
		}
		return $data;
	}

	/**
	 * 获取控制器中允许所有管理员通过url访问的方法
	 * @param  string  $controller   控制器类名(不含命名空间)
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
	final static protected function getAllow($controller=CONTROLLER_NAME){
		$controller =   'Admin\\Controller\\'.$controller.'Controller';
		$data       =   array();
		if ( is_array( $controller::$allow) ) {
			$allow  =   array_merge( $controller::$allow, self::$allow );
			foreach ( $allow as $key => $value){
				if ( is_numeric($key) ){
					$data[] = strtolower($value);
				}else{
					//可扩展
				}
			}
		}
		return $data;
	}

	/**
	 * 获取控制器中只要登录都允许访问的公共方法
	 * @param  string  $controller   控制器类名(不含命名空间)
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
	final static protected function getAllowLogin($controller=CONTROLLER_NAME){
		$controller =   'Admin\\Controller\\'.$controller.'Controller';
		$data       =   array();
		if ( is_array( $controller::$allow_login) ) {
			$allow  =   array_merge( $controller::$allow_login, self::$allow_login );
			foreach ( $allow as $key => $value){
				if ( is_numeric($key) ){
					$data[] = strtolower($value);
				}else{
					//可扩展
				}
			}
		}
		return $data;
	}
}