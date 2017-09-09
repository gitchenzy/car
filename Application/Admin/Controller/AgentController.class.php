<?php
/**
 * Created by PhpStorm.
 * User: Huge
 * Date: 2016/3/5 0005
 * Time: 14:00
 */

namespace Admin\Controller;


class AgentController extends AdminController
{
    private $ag,$ar,$emp,$ae;
    protected function _initialize(){
        parent::_initialize();
        $this -> ar =M('agentrule');
        $this -> ae =M('agentrate');
        $this -> ag =M('agent');
        $this->emp = M("employee");
    }
    //代理商管理
    public function index(){
        $this->display();
    }
    //加载代理商
    public function loadAgent(){
        $map['C.DelFlag'] = 0;
        $offset = i("offset");
        $limit = i("limit");
        $search_key = i('search_key');
        $search_value = i('search');
        if(!empty($search_value)){
            $map["C.CompanyName"] = array("like","%".$search_value."%");
        }
        $sort = i('sort');
        $order = i('order');
        $reorder = "C.Sort desc";
        if(!empty($sort)){
            $reorder = "C.".$sort." ".$order;
        }
        $count = $this->ag->alias("C")->where($map)->order($reorder)->count();
        $list =  $this->ag->alias("C")->where($map)->limit($offset,$limit)->order($reorder)->select();
        $list_array= array("total"=>$count,"rows"=>$list?$list:array());
        echo json_encode($list_array);

    }
    //添加代理商
    public function addAgent(){
        if(IS_POST){
            $data = i('post.');
            $data['Identifier'] = getAgentIdentifier();
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['AgentTime'] = date('Y-m-d H:i:s');
            $data['EmpName'] = $this->user['EmployeeID'];
            $data['OperatorID'] = $this->user['EmployeeID'];
            $where['LoginName'] = $data['LoginName'];
            $result = $this->ag -> where($where) -> find();
            if($result){
                $this -> error('账号已经存在，请重新输入账号！');
                exit;
            }

            $res = $this -> ag -> add($data);
            if($res){
                //为代理赋权限
                $dutyinfo = M('duty') -> where(array('Type'=> 2,'Status'=>1)) -> find();
                if($dutyinfo){
                    M('employee_duty') -> add(array('MemberID'=>$res,'DutyID'=>$dutyinfo['ID'],'Type'=> 2));
                }else{
                   $result =  M('duty') -> add(array('DutyName'=>'代理权限组','Type'=>2,'Module'=>'admin'));
                    M('employee_duty') -> add(array('MemberID'=>$res,'DutyID'=>$result,'Type'=> 2));
                }
                //添加成功要给初始化密码
                $string = get_string();
                $sa['Random']= $string->rand_string(6,1);
                $sa["Password"] = md5(md5($sa['Random']).$sa['Random']);
                $this->ag -> where(array('AgentID'=>$res)) -> save($sa);
                $this -> success('添加成功！您账号的初始密码为'.$sa['Random']);
            }else{
                $this -> error('添加失败！');
            }
        }else{
            $where['DelFlag'] = 0;
            $cus['ar'] = $this -> ar -> where($where) -> getField('RuleID,RuleName');
            $cus['ae'] = $this -> ae -> where($where) -> getField('RateID,RateName');
            $this->assign('cus',$cus);
            $this -> display('editAgent');
        }
    }
    //修改代理商
    public function editAgent(){
        $id = i('id');
        if(IS_POST){
            $data = i('post.');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $where['AgentID'] = $id;
            $this->ag -> where($where) -> save($data);
            //为会员赋权限
            $dutyinfo = M('duty') -> where(array('Type'=> 2,'Status'=>1)) -> find();
            if($dutyinfo){
                $d = M('employee_duty') -> where(array('MemberID'=>$id,'DutyID'=>$dutyinfo['ID'],'Type'=> 2)) -> find();
                if(!$d){
                    M('employee_duty') -> add(array('MemberID'=>$id,'DutyID'=>$dutyinfo['ID'],'Type'=> 2));
                }
            }else{
                $result =  M('duty') -> add(array('DutyName'=>'代理权限组','Type'=>2,'Module'=>'admin'));
                M('employee_duty') -> add(array('MemberID'=>$id,'DutyID'=>$result,'Type'=> 2));
            }
            $this -> success('修改成功！');
        }else{
            $where['DelFlag'] = 0;
            $cus['ar'] = $this -> ar -> where($where) -> getField('RuleID,RuleName');
            $cus['ae'] = $this -> ae -> where($where) -> getField('RateID,RateName');
            $where['AgentID'] = $id;
            $info = $this -> ag -> where($where) -> find();
            $this->assign('cus',$cus);
            $this->assign('info',$info);
            $this -> display('editAgent');
        }
    }
    //删除代理商
    public function delAgent(){

        $array_id['AgentID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> ag -> where($array_id) -> save($data);
        $this -> success('删除成功！');
    }
    //重置代理商密码
    public function editPWD(){
        if(IS_POST){
            $data = i('post.');
            $id = i('id');
            if($data['pass'] != $data['repass']){
                $this -> error('两次密码不一致！');
                exit;
            }
            $string = get_string();
            $sa['Random']= $string->rand_string(6,1);
            $sa["Password"] = md5(md5($data['pass']).$sa['Random']);
            $this->ag -> where(array('AgentID'=>$id)) -> save($sa);
            $this -> success('重置成功！');
        }else{
            $this -> display();
        }
    }
    //代理规则
    public function agentRule(){

        $this->display();
    }
    //加载代理规则
    public function loadAgentRule(){
        $value = i('search');
        $offset = i("offset");
        $limit = i("limit");
        $where['DelFlag'] = 0;
        if($value){
            $where['RuleName'] = array('LIKE',"%$value%");
        }
        $count = $this->ar -> where($where) -> order('Sort desc') -> count();
        $res = $this->ar -> where($where) -> limit($offset,$limit) -> order('Sort desc') -> select();
        foreach($res as &$v){
            $v['OperatorName'] =$this->emp -> where(array('EmployeeID' => $v['OperatorID'])) -> getField('Name');
            $v['typeName'] = $v['RuleType']==1?'交易额':'销售数量';
        }
     //   $list_array= $res?$res:array();
        $list_array= array("total"=>$count,"rows"=>$res?$res:array());
        echo json_encode($list_array);

    }
    //添加代理规则
    public function addAgentRule(){
        if(IS_POST){
            $data = i('post.');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $this -> ar -> add($data);
            $this->success('增加成功！');
        }else{
            $this-> display('editAgentRule');
        }
    }
    //修改代理规则
    public function editAgentRule(){
        $id = i('id');
        $where['RuleID'] = $id;
        $where['DelFlag'] = 0;
        if(IS_POST){
            $data = i('post.');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $this -> ar -> where($where) -> save($data);
            $this->success('修改成功！');
        }else{
            $res = $this-> ar -> where($where)-> find();
            $this->assign('info',$res);
            $this->display();
        }
    }
    //删除代理规则
    public function delAgentRule(){
        $array_id['RuleID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> ar -> where($array_id) -> save($data);
        $this -> success('删除成功！');
    }
    //代理返点
    public function agentRate(){

        $this->display();
    }
    //加载代理返点
    public function loadAgentRate(){
        $value = i('search');
        $offset = i("offset");
        $limit = i("limit");
        $where['DelFlag'] = 0;
        if($value){
            $where['RateName'] = array('LIKE',"%$value%");
        }
        $count = $this->ae -> where($where) -> order('Sort desc') -> count();
        $res = $this->ae -> where($where) -> limit($offset,$limit) -> order('Sort desc') -> select();
        foreach($res as &$v){
            $v['OperatorName'] =$this->emp -> where(array('EmployeeID' => $v['OperatorID'])) -> getField('Name');
            $v['Rate'] = $v['RateType']==1?'现金':'比例';
            $v['Commission'] = $v['CommissionType']==1?'一次性':'周期';
        }
       // $list_array= $res?$res:array();
        $list_array= array("total"=>$count,"rows"=>$res?$res:array());
        echo json_encode($list_array);
    }
    //添加代理返点
    public function addAgentRate(){
        if(IS_POST){
            $data = i('post.');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $this -> ae -> add($data);
            $this->success('增加成功！');
        }else{
            //支付方式
            $where['DelFlag']=0;
            $paytype = M('paytype') -> where($where) -> getField('PayID,PayName');
            $this -> assign('paytype',$paytype);
            $this-> display('editAgentRate');
        }

    }
    //修改代理返点
    public function editAgentRate(){
        $id = i('id');

        $where['DelFlag'] = 0;
        if(IS_POST){
            $data = i('post.');
            $where['RateID'] = $id;
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $this -> ae -> where($where) -> save($data);
            $this->success('修改成功！');
        }else{
            $paytype = M('paytype') -> where($where) -> getField('PayID,PayName');
            $this -> assign('paytype',$paytype);
            $where['RateID'] = $id;
            $res = $this-> ae -> where($where)-> find();
            $this->assign('info',$res);
            $this->display();
        }

    }
    //删除返点
    public function delAgentRate(){
        $array_id['RateID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> ae -> where($array_id) -> save($data);
        $this -> success('删除成功！');
    }



}