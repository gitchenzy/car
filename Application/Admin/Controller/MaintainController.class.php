<?php
/**
 * Created by PhpStorm.
 * User: Huge
 * Date: 2016/3/5 0005
 * Time: 14:00
 */

namespace Admin\Controller;


class MaintainController extends AdminController
{
    private $Maintain,$customer,$emp,$sop;
    protected function _initialize(){
        parent::_initialize();
        $this -> Maintain = M('Maintain');
        $this -> customer = M('customer');
        $this -> emp = M('employee');
        $this -> sop = M('sop');
    }

    public function index(){
        $this->display();
    }

    public function loadMaintain(){
        //查找这个实施人的所有记录部门负责人都可以看到信息
        if(!get_user_name()){
            $priority =$this->emp -> where(array('EmployeeID' => get_user_id())) -> getField('isPriority');
            if($priority==2){
                $allUser = M("employee_duty")->where(array("DutyID"=>21,"Type"=>1))->getField("MemberID",true);
                $stop=1;
                foreach($allUser as $v){
                    if($v ==get_user_id()){
                        $stop = 2;
                    }
                }
                if($stop != 2){
                    $where['M.EmployeeID'] = get_user_id();
                }
            }
        }

        $where['M.DelFlag'] = 0;
        $offset = i("offset");
        $limit = i("limit");
        $name = i('empName');
        $value = i('search');
        $sort = I('sort');
        $orders = I('order');

        if($sort =="Sort"){
            $order= 'M.TraceTime desc';
        }else{
            $order = 'M.'.$sort.' '.$orders;
        }

        // select * from maintain m  left join customer c on c.CustomerID=m.CustomerID where m.DelFlag = 0 and c.FullName like '%吴%'
        if($value){
            $where['c.ShortName'] = array('like','%'.$value.'%');
        }
        if($name){
            $where['e.Name'] = array('like',"%$name%");
        }
        $count = $this->Maintain->alias("M")
            ->join("customer as c on  c.CustomerID =  M.CustomerID",'left')
            ->join("employee as e on e.EmployeeID = M.EmployeeID and e.DelFlag = 0",'left')
            -> where($where)
            -> order($order)
            ->count();
        $MaintainInfo = $this -> Maintain -> alias("M")
            ->join("customer as c on  c.CustomerID =  M.CustomerID",'left')
            ->join("employee as e on e.EmployeeID = M.EmployeeID and e.DelFlag = 0",'left')
            -> where($where)
            -> field('c.ShortName as CustomerName,c.CtmStatusID,M.*')
            -> limit($offset,$limit)-> order('Sort desc') -> order($order) ->select();
        foreach($MaintainInfo as &$v){
            $v['EmpName'] =M('employee') -> where(array('EmployeeID' => $v['EmployeeID'])) -> getField('Name');
            //跟进实施人员的名字
            $v['OperatorName'] =M('employee') -> where(array('EmployeeID' => $v['OperatorID'])) -> getField('Name');
            //客户状态
            $v['StateName'] = M('customerstatus') -> where(array('CtmStatusID' => $v['CtmStatusID'])) -> getField('CtmStatusName');
            //截取实施内容
            $v['Content'] = strip_tags($v['Content']);
            $v['Content'] = msubstr($v['Content'],0,40);
        }
       // $list_array= $MaintainInfo?$MaintainInfo:array();
        $list_array= array("total"=>$count,"rows"=>$MaintainInfo?$MaintainInfo:array());
        echo json_encode($list_array);
    }
    //增加实施记录
    public function addMaintain(){
        if(IS_POST){
            $_POST['EmployeeID'] = $this->user['EmployeeID'];
            $_POST['OperatorID'] = $this->user['EmployeeID'];
            $_POST['ModifyTime'] = date('Y-m-d H:i:s');
            $_POST['CreateTime'] = date('Y-m-d H:i:s');
            $_POST['CustomerID'] = $this->customer ->where(array('ShortName'=>$_POST['ShortName'])) -> getfield('CustomerID');
            if(!$_POST['ShortName'] || !$_POST['CustomerID']){
                $this -> error('请选择客户！');
            }
            unset($_POST['ShortName']);
            $res = $this -> Maintain -> add($_POST);
            if($res){
                //当增加实施记录则改变客户的状态
                $where['CustomerID'] = i('CustomerID');
                $data['CtmStatusID'] = i('CtmStatusID');
                M('customer') -> where($where) -> save($data);
            }
            $this->success('增加成功！');
        }else{
            //客户信息
            $where['Status'] = 0;
            $where['DelFlag'] = 0;
            if(!get_user_name()){
                $where["Sources"] = $this->user["LoginType"];
                $where["DeveloperID"] = $this->user["EmployeeID"];
            }
            $res = M('customer') -> where($where) -> getField('CustomerID,FullName');
            //选择客户状态
            $cs = M('customerstatus') -> where(array('DelFlag'=>0)) -> getField('CtmStatusID,CtmStatusName');
            $this->assign('cInfo',$res);
            $this->assign('cs',$cs);
            $this-> display('editMaintain');
        }
    }
    //编辑修改实施记录
    public function editMaintain(){
        $id = i('MaintainID');
        $m = $this -> Maintain -> where(array('MaintainID'=>$id,'DelFlag'=>0)) -> find();
        if(IS_POST){
            $_POST['ModifyTime'] = date('Y-m-d H:i:s');
            $_POST['OperatorID'] = $this->user['EmployeeID'];

            $res = $this -> Maintain -> where(array('MaintainID'=>$id,'DelFlag'=>0)) -> save($_POST);
            if($res){
                //当修改实施记录则改变客户的状态
                $where['CustomerID'] = i('CustomerID');
                $data['CtmStatusID'] = i('CtmStatusID');
                M('customer') -> where($where) -> save($data);
            }
            $this->success('修改成功！');
        }else{
            //客户信息
            $where['Status'] = 0;
            $where['DelFlag'] = 0;
            if(!get_user_name()){
                $where["Sources"] = $this->user["LoginType"];
                $where["DeveloperID"] = $this->user["EmployeeID"];
            }
            $res = M('customer') -> where($where) -> getField('CustomerID,FullName');
            //选择客户状态
            $cs = M('customerstatus') -> where(array('DelFlag'=>0)) -> getField('CtmStatusID,CtmStatusName');
            $m['state'] = M('customer') -> where(array('CustomerID'=>$m['CustomerID'])) -> getField('CtmStatusID');
            $m['ShortName'] = $this->customer -> where(array('CustomerID'=>$m['CustomerID'])) -> getField('ShortName');
            $this->assign('cInfo',$res);
            $this->assign('cs',$cs);
            $this->assign('info',$m);
            $this-> display();
        }
    }
    //删除实施记录
    public function delMain(){
        $array_id['MaintainID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> Maintain -> where($array_id) -> save($data);

        $this -> success('删除成功！');
    }
    //查看详情
    public function seeMaintain(){
        $where['MaintainID'] = i('MaintainID');
        $info = $this -> Maintain -> field('Content,Result,EmployeeID,CustomerID') -> where($where) -> find();
        $info['EmpName'] =M('employee') -> where(array('EmployeeID' => $info['EmployeeID'])) -> getField('Name');
        $info['CustomerName'] =M('customer') -> where(array('CustomerID' => $info['CustomerID'])) -> getField('ShortName');
        $this->assign('info',$info);
        $this -> display();
    }
    //申请实施
    public function mainSop(){

        $this->display();
    }
    //遍历申请实施
    public function loadMainSop(){

        if(!get_user_name()){
            $mnum = $this->emp -> where(array('EmployeeID'=>get_user_id())) -> getField('isPriority');
            if($mnum != 1){
                $where['S.ServicesID'] = get_user_id();
            }
        }
        //每次加载都先判断未完成的实施是否超时
        //先查找出所有的未完成的实施
        $map['ForceStatus'] = array('elt',2);
        $info['ForceStatus'] = 3;
        $res = $this->sop->where($map)->select();
        $time = time();
        foreach($res as $r){
            if($r['ForceTime']){
                $timenum = strtotime($r['ForceTime'])+$r['ConditionTime']*24*60*60;
                if($timenum < $time){
                    $this->sop->where(array('SOPID'=>$r['SOPID']))->save($info);
                    //要发四封邮件客服 市场 实施主管 实施人员
                    $ting = $r['MarketID'].','.$r['ServicesID'].','.$r['EmployeeID'].','.$r['ForceID'];
                    $cName =$this->customer -> where(array('Identifier'=>$r['CtmID'])) -> getField('ShortName');
                    $fName =M('employee') -> where(array('EmployeeID'=>$r['CtmID'])) -> getField('Name');
                    $email =M('employee') -> where(array('EmployeeID'=>array('in',$ting))) -> getField('Email');
                    $content = '实施申请超时：客户为'.$cName.'实施人为'.$fName.'请上crm进行查看';
                    foreach($email as $e){
                        sendEmail($e,'实施超时',$content);
                    }
                }
            }
        }

        $where['S.DelFlag'] = 0;
        $offset = i("offset");
        $limit = i("limit");
        $name = i('empName');
        $value = i('search');
        // select * from maintain m  left join customer c on c.CustomerID=m.CustomerID where m.DelFlag = 0 and c.FullName like '%吴%'
        $count = $this->sop->alias('S')
            ->join('contract as c on S.ConID=c.ContractID','left')
            ->join('customer as cs on S.CtmID=cs.Identifier','left')
            ->join('employee as e on S.ForceID=e.EmployeeID','left')
            -> where($where)
            -> field('S.*,c.CttNumber')
            ->count();
        $MaintainInfo = $this -> sop->alias('S')
            ->join('contract as c on S.ConID=c.ContractID','left')
            ->join('customer as cs on S.CtmID=cs.Identifier','left')
            ->join('employee as e on S.ForceID=e.EmployeeID','left')
            -> where($where)
            -> field('S.*,c.CttNumber,c.Address,cs.Qq,cs.Mobile,c.CtmSign,e.Name')
            -> limit($offset,$limit) ->select();
        $ForceStatus = array(1=>'未实施', 2=>'实施中' ,3=>'实施超时',4=>'上线');
        foreach($MaintainInfo as &$v){
            //客户名字
            $v['CustomerName'] =$this->customer -> where(array('Identifier'=>$v['CtmID'])) -> getField('ShortName');
            //实施状态
            $v['ForceStatusName'] =$ForceStatus[$v['ForceStatus']];
        }
        // $list_array= $MaintainInfo?$MaintainInfo:array();
        $list_array= array("total"=>$count,"rows"=>$MaintainInfo?$MaintainInfo:array());
        echo json_encode($list_array);
    }
    //修改申请记录
    public function editMainSop(){
        $id = I('SOPID');
        if(IS_POST){
            $data = I('post.');
            $data['ApplyTime'] = date('Y-m-d H:i:s');
            $res = $this -> sop -> where(array('SOPID'=>$id)) -> save($data);
            $this->success('编辑成功！');
            //查询实施主管并且发送邮件
            $info['DepartmentNum'] = 2;
            $info['isPriority'] = 1;
            $info['DelFlag'] = 0;
            $content = '温馨提醒：请登录果园CRM系统尽快处理申请实施编号为'.$id.'记录，并指派实施人员进行现场实施！';
            $person = $this->emp -> field('Email') -> where($info) -> select();
            foreach($person as $v){
                sendEmail($v['Email'],'请审核并指派实施人员！',$content);
            }

        }else{
            $res = $this -> sop -> where(array('SOPID'=>$id)) -> find();
            $res['ShortName'] =$this->customer -> where(array('Identifier'=>$res['CtmID'])) -> getField('ShortName');
            $this->assign('info',$res);
            $this->display();
        }
    }
    //指派实施人员
    public function appointSop(){
        $id = I('SOPID');
        if(IS_POST){
            $data = i('post.');
            $data['EmployeeID'] = get_user_id();
            //$res = $this -> sop -> where(array('SOPID'=>$id)) -> getField('ForceStatus');
           // if($res <2){
                $data['ForceStatus'] = 2;
                $data['ForceTime'] = date('Y-m-d H:i:s');
                $this -> sop -> where(array('SOPID'=>$id)) -> save($data);
                $this->success('指派成功！');
          //  }else{
          //      $this->error('该记录已经被指派过！');
          //  }
        }else{
            $info = $this -> sop -> where(array('SOPID'=>$id)) -> find();
            $data['ShortName'] =$this->customer -> where(array('Identifier'=>$info['CtmID'])) -> getField('ShortName');
            $data['ConditionTime'] =$info['ConditionTime'];
            $res = $this->emp ->where(array('DepartmentNum'=>2,'DelFlag'=>0)) -> getField("EmployeeID,Name");
            $this->assign('info',$res);
            $this->assign('data',$data);
            $this->display();
        }
    }
    //确认实施
    public function confirmSop(){

        if(IS_POST){
            $id = I('SOPID');
            $data['ForceStatus'] = 4;
            $data['FinishTime'] = date('Y-m-d H:i:s');
            $data['Note'] = I('Note');
            $res = $this -> sop -> where(array('SOPID'=>$id)) -> getField('ForceStatus');
            if($res < 4){
                $this -> sop -> where(array('SOPID'=>$id)) -> save($data);
                $this->success('确认完成！');
            }else{
                $this->error('该记录已经确认！');
            }

        }else{

            $this -> display();
        }
    }
    //查看实施详情
    public function seeMainSop(){
        $id = I('SOPID');
        $info = $this -> sop -> where(array('SOPID'=>$id)) -> find();
        $cinfo =$this->customer -> where(array('Identifier'=>$info['CtmID'])) -> find();
        //查找出要的合同信息
        $pinfo =M('contract') -> where(array('ContractID'=>$info['ConID'])) -> find();
        $pName = M('product') -> where(array('ProductID'=>array('in',$pinfo['CttProductID']))) -> getField('ProductName',true);
        $pinfo['PName'] = implode(',',$pName);
        $info['FName'] = M('employee') -> where(array('EmployeeID'=>$info['ForceID'])) -> getField('Name');
        $info['MName'] = M('employee') -> where(array('EmployeeID'=>$info['MarketID'])) -> getField('Name');
        $info['SName'] = M('employee') -> where(array('EmployeeID'=>$info['ServicesID'])) -> getField('Name');
        $info['EName'] = M('employee') -> where(array('EmployeeID'=>$info['EmployeeID'])) -> getField('Name');
        $array=array(1=>'未实施',2=>'实施中',3=>'实施超时',4=>'上线');
        $info['StatusName'] = $array[$info['ForceStatus']];
        if($info['ForceTime']){
            $info['OutForceTime'] = date('Y-m-d H:i:s',strtotime($info['ForceTime'])+$info['ConditionTime']*24*60*60);
        }
        //查看实施信息
        $zhengz = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        $main_info = M('maintain') -> where(array('CustomerID'=>$cinfo['CustomerID'])) -> order('TraceTime desc') -> limit(0,10) ->select();
        foreach($main_info as &$main){
            $main['EmpName'] = $this->emp -> where(array('EmployeeID' => $main['EmployeeID'])) -> getfield('Name');
            $main['Content'] = preg_replace($zhengz,'',htmlspecialchars_decode($main['Content']));
        }
        $this -> assign('info',$info);
        $this -> assign('cinfo',$cinfo);
        $this -> assign('pinfo',$pinfo);
        $this -> assign('main_info',$main_info);
        $this -> display();
    }
    //待实施客户列表
    public function noMain(){
        $this -> display();
    }
    //加载
    public function loadNoMain(){

        if(!get_user_name()){
            $mnum = $this->emp -> where(array('EmployeeID'=>get_user_id)) -> getField('isPriority');
            if($mnum != 1){
                $where['ServicesID'] = get_user_id();
            }
        }

        $where['DelFlag'] = 0;
        $where['ForceStatus'] = 1;
        $offset = i("offset");
        $limit = i("limit");
        $name = i('empName');
        $value = i('search');
        // select * from maintain m  left join customer c on c.CustomerID=m.CustomerID where m.DelFlag = 0 and c.FullName like '%吴%'
        $count = $this->sop
            -> where($where)
            ->count();
        $MaintainInfo = $this -> sop
            -> where($where)
            -> limit($offset,$limit) ->select();
        $ForceStatus = array(1=>'未实施', 2=>'实施中' ,3=>'实施超时',4=>'上线');
        foreach($MaintainInfo as &$v){
            //客户名字
            $v['CustomerName'] =$this->customer -> where(array('Identifier'=>$v['CtmID'])) -> getField('ShortName');
            //实施状态
            $v['ForceStatusName'] =$ForceStatus[$v['ForceStatus']];
        }
        // $list_array= $MaintainInfo?$MaintainInfo:array();
        $list_array= array("total"=>$count,"rows"=>$MaintainInfo?$MaintainInfo:array());
        echo json_encode($list_array);
    }
    //已实施客户列表
    public function  finishMain(){
        $this -> display();
    }
    //加载
    public function loadFinishMain(){
        if(!get_user_name()){
            $mnum = $this->emp -> where(array('EmployeeID'=>get_user_id)) -> getField('isPriority');
            if($mnum != 1){
                $where['ServicesID'] = get_user_id();
            }
        }
        $where['DelFlag'] = 0;
        $where['ForceStatus'] = array('GT',1);
        $offset = i("offset");
        $limit = i("limit");
        $name = i('empName');
        $value = i('search');
        // select * from maintain m  left join customer c on c.CustomerID=m.CustomerID where m.DelFlag = 0 and c.FullName like '%吴%'
        $count = $this->sop
            -> where($where)
            ->count();
        $MaintainInfo = $this -> sop
            -> where($where)
            -> limit($offset,$limit) ->select();
        $ForceStatus = array(1=>'未实施', 2=>'实施中' ,3=>'实施超时',4=>'上线');
        foreach($MaintainInfo as &$v){
            //客户名字
            $v['CustomerName'] =$this->customer -> where(array('Identifier'=>$v['CtmID'])) -> getField('ShortName');
            //实施状态
            $v['ForceStatusName'] =$ForceStatus[$v['ForceStatus']];
        }
        // $list_array= $MaintainInfo?$MaintainInfo:array();
        $list_array= array("total"=>$count,"rows"=>$MaintainInfo?$MaintainInfo:array());
        echo json_encode($list_array);
    }






















}