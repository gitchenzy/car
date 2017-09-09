<?php
/**
 * Created by PhpStorm.
 * User: Huge
 * Date: 2016/3/5 0005
 * Time: 14:00
 */

namespace Admin\Controller;

use Org\Net\Http;
use Think\Log;
class MarketController extends AdminController
{
    private $contractType,$emp,$contract,$customer,$product,$pay,$market;
    protected function _initialize(){
        parent::_initialize();
        $this -> market = M('market');
        $this -> contract = M('contract');
        $this -> contractType = M('contracttype');
        $this->emp = M("employee");
        $this->customer = M("customer");
        $this->product = M("product");
        $this->pay = M("paytype");
    }
    //市场记录
    public function index(){
        $this->display();
    }
    //加载市场记录
    public function loadMarket(){

        $where['M.DelFlag'] = 0;
        $value = i('search');
        $name = i('empName');
        $offset = i("offset");
        $timeA = i("TimeA");
        $timeB = i("TimeB");
        $timeC = i("TimeC");
        $timeD = i("TimeD");
        $limit = i("limit");
        $sort = i('sort');
        $o = i('order');
        $order = 'M.'.$sort.' '.$o;
        if($value){
            $where['c.ShortName'] = array('like',"%$value%");
        }
        if($name){
            $where['e.Name'] = array('like',"%$name%");
        }

        if($timeA && !$timeB){
            $where["M.CreateTime"] = array("gt",$timeA);
        }
        if($timeA && $timeB){
            $where["M.CreateTime"] = array("between",array($timeA,$timeB));
        }
        if(!$timeA && $timeB){
            $where["M.CreateTime"] = array("lt",$timeB);
        }
        if($timeC && !$timeD){
            $where["M.GenTime"] = array("gt",$timeC);
        }
        if($timeC && $timeD){
            $where["M.GenTime"] = array("between",array($timeC,$timeD));
        }
        if(!$timeC && $timeD){
            $where["M.GenTime"] = array("lt",$timeD);
        }

        if(!get_user_name()){
            $priority =$this->emp -> where(array('EmployeeID' => get_user_id())) -> getField('isPriority');
            if($priority==2){
                $where['M.EmpID'] = get_user_id();
            }
        }

        $count = $this -> market ->alias("M")
            ->join("customer as c on c.Identifier = M.Identifier and c.DelFlag = 0",'left')
            ->join("employee as e on e.EmployeeID = M.EmpID and e.DelFlag = 0",'left')
            -> where($where)
            -> field('c.FullName as CustomerName,M.*')
            -> order($order) -> count();
        $MarketInfo = $this -> market -> alias("M")
            ->join("customer as c on c.Identifier = M.Identifier and c.DelFlag = 0",'left')
            ->join("employee as e on e.EmployeeID = M.EmpID and e.DelFlag = 0",'left')
            -> where($where)
            -> field('c.ShortName as CustomerName,M.*')
            -> limit($offset,$limit)
            -> order($order) -> select();
        foreach($MarketInfo as &$v){
            $v['EmpName'] =M('employee') -> where(array('EmployeeID' => $v['EmpID'])) -> getField('Name');
            $v['Content'] = strip_tags(htmlspecialchars_decode($v['Content']));
            $content = msubstr($v['Content'],0,24,'utf-8');
            $v['Content'] = "<span title='{$v['Content']}'>{$content}</span>";
        }
       // $list_array= $MarketInfo?$MarketInfo:array();
        $list_array= array("total"=>$count,"rows"=>$MarketInfo?$MarketInfo:array());
        echo json_encode($list_array);
    }
    //新增市场记录
    public function addMarket(){
        if(IS_POST){
            $data = i('post.');
            $data['EmpID'] = $this->user['EmployeeID'];
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['Identifier'] = $this->customer ->where(array('ShortName'=>$data['ShortName'])) -> getfield('Identifier');
            if(!$data['ShortName'] || !$data['Identifier']){
                $this -> error('请选择客户！');
            }
            unset($data['ShortName']);
            $data['CreateTime'] = date('Y-m-d H:i:s');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $res = $this -> market -> add($data);
            if($res){
                //当增加实施记录则改变客户的状态
                $where['Identifier'] = $data['Identifier'];
                $data['CtmStatusID'] = i('CtmStatusID');
                $this->customer -> where($where) -> save($data);
            }
            $this->success('增加成功！');
        }else{
            //客户信息
            $where['Status'] = 0;
            $where['DelFlag'] = 0;
            // Array ( [EmployeeNum] => 10010001 [EmployeeID] => 4 [LoginType] => 1 )
            if(!get_user_name()) {
                $where["Sources"] = $this->user["LoginType"];
                $where["DeveloperID"] = $this->user["EmployeeID"];
            }
            $res = $this->customer -> where($where) -> field('Identifier,FullName') -> select();
            //选择客户状态
            $cs = M('customerstatus') -> where(array('DelFlag'=>0)) -> getField('CtmStatusID,CtmStatusName');
            //选择协同人

            $map['DepartmentNum'] = 1001;

            $coop = $this->emp -> where($map) -> getField('EmployeeID,Name');
            $coop[0] = '无协同人';

            $this->assign('cs',$cs);
            $this->assign('coop',$coop);
            $this->assign('cInfo',$res);
            $this-> display('editMarket');
        }
    }
    //编辑修改市场记录
    public function editMarket(){
        $id = i('id');
        $m = $this -> market -> where(array('MarketID'=>$id,'DelFlag'=>0)) -> find();
        if(IS_POST){
            $data = i('post.');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['Identifier'] = $this->customer ->where(array('ShortName'=>$data['ShortName'])) -> getfield('Identifier');
            if(!$data['ShortName'] || !$data['Identifier']){
                $this -> error('请选择客户！');
            }
            $res = $this -> market -> where(array('MarketID'=>$id,'DelFlag'=>0)) -> save($data);
            if($res){
                //当修改市场记录则改变客户的状态
                $where['Identifier'] = $data['Identifier'];
                $data['CtmStatusID'] = i('CtmStatusID');
                $this->customer -> where($where) -> save($data);
            }
            $this->success('修改成功！');
        }else{
            //客户信息
            $where['Status'] = 0;
            $where['DelFlag'] = 0;
            if(!get_user_name()) {
                $where["Sources"] = $this->user["LoginType"];
                $where["DeveloperID"] = $this->user["EmployeeID"];
            }
            $res = $this->customer -> where($where) -> field('Identifier,FullName') -> select();
            //选择客户状态
            $cs = M('customerstatus') -> where(array('DelFlag'=>0)) -> getField('CtmStatusID,CtmStatusName');
            //选择协同人
            if(!get_user_name()){
                $emp['EmployeeID'] = get_user_id();
                $map['DepartmentNum'] = $this->emp -> where($emp) -> getField('DepartmentNum');
            }
            $coop = $this->emp -> where($map) -> getField('EmployeeID,Name');
            $coop[0] = '无协同人';
            $m['state'] = $this->customer -> where(array('Identifier'=>$m['Identifier'])) -> getField('CtmStatusID');
            $m['ShortName'] = $this->customer -> where(array('Identifier'=>$m['Identifier'])) -> getField('ShortName');
            $this->assign('cs',$cs);
            $this->assign('cInfo',$res);
            $this->assign('coop',$coop);
            $this->assign('info',$m);
            $this-> display();
        }
    }
    //删除市场记录
    public function delMarket(){

        $array_id['MarketID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> market -> where($array_id) -> save($data);
        $this -> success('删除成功！');
    }


    //合同类型
    public function contractType(){
        $this->assign("crumbs_title","合同类型");
        $this->display();
    }
    //加载合同类型
    public function loadContractType(){
        $value = i('search');
        $where['DelFlag'] = 0;
        $offset = i("offset");
        $limit = i("limit");
        if($value){
            $where['CttTypeName'] = array('LIKE',"%$value%");
        }

        $count = $this->contractType -> where($where) -> order('Sort desc') -> count();
        $res = $this->contractType -> where($where) -> limit($offset,$limit) -> order('Sort desc') -> select();
        foreach($res as &$v){
            $v['OperatorName'] =$this->emp -> where(array('EmployeeID' => $v['OperatorID'])) -> getField('Name');
        }
       // $list_array= $res?$res:array();
        $list_array= array("total"=>$count,"rows"=>$res?$res:array());
        echo json_encode($list_array);
    }
    //新增合同类型
    public function addContractType(){
        if(IS_POST){
            $data = i('post.');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $this->contractType -> add($data);
            $this->success('增加成功！');
        }else{
            $this-> display('editContractType');
        }
    }
    //修改合同类型
    public function editContractType(){
        $id = i('id');
        $where['CttTypeID'] = $id;
        $where['DelFlag'] = 0;
        if(IS_POST){
            $data = i('post.');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $this -> contractType -> where($where) -> save($data);
            $this->success('修改成功！');
        }else{
            //客户信息
            $res = $this-> contractType -> where($where)-> find();
            $this->assign('info',$res);
            $this-> display();
        }
    }
    //删除合同类型
    public function delContractType(){
        $array_id['CttTypeID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];

        $this -> contractType -> where($array_id) -> save($data);

        $this -> success('删除成功！');
    }
    //合同信息
    public function contract(){
        $this -> display();
    }
    //加载合同信息
    public function loadContract(){
        $value = i('search');
        $where['DelFlag'] = 0;
        $offset = i("offset");
        $limit = i("limit");
        $timeC = I('timeC');
        $timeD = I('timeD');
        $o = I('order');
        $sort = I('sort');
        $order = $sort.' '.$o;

        if($timeC && !$timeD){
            $where["SignTime"] = array("gt",$timeC);
        }
        if($timeC && $timeD){
            $where["SignTime"] = array("between",array($timeC,$timeD));
        }
        if(!$timeC && $timeD){
            $where["SignTime"] = array("lt",$timeD);
        }
        if($value){
            $where['CttNumber'] = array('LIKE',"%$value%");
        }
        $where['DelFlag'] = 0;
        $count = $this->contract -> where($where) -> order($order) -> count();
        $res = $this->contract -> where($where) ->limit($offset,$limit) -> order($order) -> select();
        foreach($res as &$v){
            $v['OperatorName'] =$this->emp -> where(array('EmployeeID' => $v['OperatorID'])) -> getField('Name');

            $produ = $this->product -> where(array('ProductID'=>array('in',$v['CttProductID']))) -> getField('ProductName',true);
            $v['ProductName'] =implode(',',$produ);
            $v['CttTypeName'] =$this->contractType -> where(array('CttTypeID' => $v['CttTypeID'])) -> getField('CttTypeName');
            $v['CustomerName'] =$this->customer -> where(array('Identifier' => $v['Identifier'],'DelFlag'=>0)) -> getField('ShortName');
        }
        $list_array= array("total"=>$count,"rows"=>$res?$res:array());
       // $list_array= $res?$res:array();
        echo json_encode($list_array);
    }
    //添加合同信息
    public function addContract(){
        if(IS_POST){
            $data = i('post.');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $account["AuthType"] = $data['CttProductID'] = implode(',',$data['productID']);
            $account["FinishTime"] = $data["FinishTime"];
         //   $account["remark"] = $data["PlanContent"];
            $info['ImgPath'] = $data['ScanName'];
            $info['ImgType'] = 1;
            $data['Identifier'] = $this->customer ->where(array('ShortName'=>$data['ShortName'])) -> getfield('Identifier');
            $mid = $data['Identifier'];
            if(!$data['ShortName'] || !$data['Identifier']){
                $this -> error('请选择客户！');
            }

            $res = M('scanimage') -> add($info);
            $data['ScanID'] = $res;
            unset($data['ScanName']);
            $conID = $this->contract -> add($data);
            //调用官网接口自动注册账号  $account["AuthType"]
            //调接口添加用户
            //http://parkadmin.goooy.cn/User/CustomerApplyForFree
            //company_name，company_address，company_rawer，account，mobile，ip，timestamp，key_value，sign
            //Array ( [company_name] => XX公司 [company_address] => 华大 [company_rawer] => Tiger [account] => xiguaa [mobile] => 13960239809 )
            //$isExist = $this->checkAccount();

            $key = "C95C2AF559";
            $secret = "guoyuan";

            $account["customer_id"] = 'NULL';
            $account["account"] = $data["SiteAddress"];
            $account["mobile"] = $data["Telephone"];
            $account["ip"] = get_client_ip();
            $account["timestamp"] = time_format();
            $account["company_name"] = $data["ShortName"];
            $account["company_address"] = $data["Address"];
            $account["company_rawer"] = $data["CtmPrincipal"];
            $account["domain_name"] = $account["account"];
            foreach($account as $ac => $a){
                $account[$ac] = trim($a);
            }
            $account["key_value"] = $key;
            $account = $this->argSort($account);
            //echo $this->createLinkstring($account);die();
            $account['sign'] = $this->md5Sign($this->createLinkstring($account),$secret);

            $account['sign'] = strtoupper($account['sign']);

            $result = Http::http_post("http://parkadmin.goooy.cn/User/CustomerApply",$account);
            $result = json_decode($result);
            if($result->status == 1){
                $this->sendEmail($conID,$result->info);
                $this->success($result->info);
            }else{
                $this->error($result->info);
            }
            /*
            $temp = json_decode($result,true);
            if($temp["status"] == 1){  //1开通成功
                $this->success($temp["msg"],'/admin/Market/contract');
            }else{
                $this->error($temp["msg"]);
            }*/
        }else{
            $where['DelFlag'] = 0;
            //客户信息
            $cInfo = $this->customer ->where($where) -> getField("Identifier,FullName");
            //合同类型
            $ttInfo = $this->contractType -> where($where) -> getField("CttTypeID,CttTypeName");
            //产品product
            $product = $this->product ->where($where) -> field("ProductID,ProductName") -> select();
           // dump($product);
            //支付方式
            $pay = $this->pay ->where($where) -> getField("PayID,PayName");
            $this->assign('cInfo',$cInfo);
            $this->assign('ttInfo',$ttInfo);
            $this->assign('product',$product);
            $this->assign('pay',$pay);
            $this -> display('editContract');
        }

    }
    public function sendEmail($cid,$mid){
        if($cid>0){ //新增的合同ID大于0
            //取客服组的人并发送邮件
            //DutyID=14 Type =1
            $allUser = M("employee_duty")->where(array("DutyID"=>20,"Type"=>1))->getField("MemberID",true);
            $key = array_rand($allUser,1);
             $addInfo["ServicesID"] = $allUser[$key];

            $services = M('config') -> where(array('DelFlag' => 0)) -> getField('Value');
         //   $services = M("employee")->where(array("EmployeeID"=>$allUser[$key]))->getField("Email");


            $addInfo["CtmID"] = M("contract")->where(array("ContractID"=>$cid))->getField("Identifier");
            $addInfo["ConID"] = $cid;
            $addInfo["CreateTime"] = time_format();
            $addInfo["CustomerID"] = $mid;
            $addInfo["MarketID"] = $this->user['EmployeeID'];
            $addInfo["ProductID"] = M("contract")->where(array("ContractID"=>$cid))->getField("CttProductID");
            M("sop")->add($addInfo);
            $cusName = M("customer")->where(array('Identifier'=>$addInfo["CtmID"]))->find();
            $conName = M("contract")->where(array('ContractID'=>$cid))->find();
            //查找合同 。查找出域名
            $ProductName =M('product') -> where(array('ProductID'=>array('in',$conName['CttProductID']))) -> getField('ProductName',true);
          //  $EmailContent = "您有一个开通系统的订单需要审核，请在半小时内完成审核！合同编号为".$cusName['FullName'].'客户编号为：'.$addInfo["CtmID"];
            $EmailContent = "公司名称：".$cusName['FullName'].'<br>';
            $EmailContent .= "公司简称：".$cusName['ShortName'].'<br>';
            $EmailContent .= "联系人：".$cusName['Contacter'].'<br>';
            $EmailContent .= "qq：".$cusName['Qq'].'<br>';
            $EmailContent .= "Email：".$cusName['Email'].'<br>';
            $EmailContent .= "电话：".$cusName['Mobile'].'<br>';
            //域名，开通的产品，邮箱
            $EmailContent .= "CRM账号：".$cusName['LoginName'].'<br>';
            $EmailContent .= "CRM密码：".$cusName['Random'].'<br>';
            $EmailContent .= "域名：".$conName['SiteAddress'].'<br>';
            $EmailContent .= "产品：".implode(',',$ProductName).'<br>';
            $EmailContent .= "有效期至：".$conName['FinishTime'].'<br>';

            sendEmail($services,'审核订单！',$EmailContent);
        }
    }
    public function remoteSuccess(){
        Log::record("remote Access" , Log::INFO);
        $data=i("post.");

        if($data["Status"]==1){
            $cond["CustomerID"] = $data["CustomerID"];
            $cond["DelFlag"] = 0;
            $saveInfo["OpenTime"] = time_format();
            $saveInfo["Status"] = 1;


        //    $allUser = M("employee_duty")->where(array("DutyID"=>20,"Type"=>1))->getField("MemberID",true);
         //   $key = array_rand($allUser,1);
         //   $saveInfo["ServicesID"] = $allUser[$key];

            $result = M("sop")->where($cond)->save($saveInfo);
            if($result){  //ERP开通后更新成功
                $receiveUser = M("sop")->field("MarketID,ServicesID,EmployeeID,ForceID")->where($cond)->find();
                $ConID = M("sop")->where($cond)->getfield("ConID");
                $contract = M("contract")->where(array('ContractID'=>$ConID))->find();
                $cusName = M("contract")->where(array('Identifier'=>$contract['Identifier']))->find();
                foreach($receiveUser as $ru => $u){
                    if(!empty($u)){
                        $tempEmail = M("employee")->where(array("EmployeeID"=>$u,'DelFlag'=>0))->getField("Email");

                     //   $EmailContent = "客户编号为".$cond["CustomerID"]."的系统已经开通成功，敬请关注后续流程！";
                        $EmailContent = "公司名：".$cusName['FullName'].'<br>';

                        $EmailContent .= "联系人：".$cusName['Contacter'].'<br>';
                        $EmailContent .= "qq：".$cusName['Qq'].'<br>';
                        $EmailContent .= "电话：".$cusName['Mobile'].'<br>';
                        //域名，开通的产品，邮箱
                        $EmailContent .= "CRM账号：".$cusName['LoginName'].'<br>';
                        $EmailContent .= "CRM密码：".$cusName['Random'].'<br>';
                     //   $EmailContent .= "购买的产品：".$productName.'<br>';

                        sendEmail($tempEmail,$cusName,$EmailContent);
                    }
                }
            }
        }
    }
    //修改合同信息
    public function editContract(){
        $id = i('id');
        $info = $this->contract ->where(array('ContractID'=> $id)) -> find();
        if(IS_POST){

            $data = i('post.');
            $data['Identifier'] = $this->customer ->where(array('ShortName'=>$data['ShortName'])) -> getfield('Identifier');
            if(!$data['ShortName'] || !$data['Identifier']){
                $this -> error('请选择客户！');
            }
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            //判断合同扫描件有没有修改
            $res = M('scanimage') -> where(array('ImgID'=>$info['ScanID'])) -> field('ImgPath') ->find();
            if($res){
                if(basename($data['ScanName']) != basename($res['ImgPath'])){
                    unlink($res['ImgPath']);
                    $info['ImgPath'] = $data['ScanName'];
                    $info['ImgType'] = 1;
                    M('scanimage') -> where(array('ContractID'=>$id)) ->save($info);
                }
            }else{
                $info['ImgPath'] = $data['ScanName'];
                $info['ImgType'] = 1;
                $res = M('scanimage') -> add($info);
                $data['ScanID'] = $res;
            }
            //产品
            $data['CttProductID'] = implode(',',$data['productID']);
            unset($data['productID']);
            $this->contract -> where(array('ContractID'=>$id)) ->save($data);
            $this->success('修改成功！','/admin/Market/contract');

        }else{
            $where['DelFlag'] = 0;
            //客户信息
         //   $cInfo = $this->customer ->where($where) -> getField("Identifier,FullName");
            //合同类型
            $ttInfo = $this->contractType -> where($where) -> getField("CttTypeID,CttTypeName");
            //产品product
            $product = $this->product ->where($where) -> field("ProductID,ProductName") -> select();
            $array = explode(',',$info['CttProductID']);
            foreach($product as &$p){
                if(in_array($p['ProductID'],$array)){
                    $p['checked'] = 'checked';
                }
            }

            //支付方式
            $pay = $this->pay ->where($where) -> getField("PayID,PayName");
            $where['ContractID'] = $id;
        //    $info = $this->contract ->where($where) -> find();
            $info['ScanName'] =  M('scanimage') -> where(array('ImgID'=>$info['ScanID'])) -> getField('ImgPath');
            $info['ShortName'] = $this->customer ->where(array('Identifier'=>$info['Identifier'])) -> getfield('ShortName');
          //  $this->assign('cInfo',$cInfo);
            $this->assign('ttInfo',$ttInfo);
            $this->assign('product',$product);
            $this->assign('pay',$pay);
            $this->assign('info',$info);
            $this -> display();
        }
    }
    //删除合同信息
    public function delContract(){
        $array_id['ContractID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> contract -> where($array_id) -> save($data);
        $this -> success('删除成功！');
    }
    //查看合同详情
    public function seeContract(){

        $id = I('id');
        $array_id['ContractID'] = array('in',$id);

        $res= $this -> contract -> where($array_id) -> find();
    //    $res['OperatorName'] =$this->emp -> where(array('EmployeeID' => $res['OperatorID'])) -> getField('Name');
       $product =$this->product -> where(array('ProductID' =>array('in',$res['CttProductID']))) -> getField('ProductName',true);
        $res['ProductName'] = implode('，',$product);
        $res['CttTypeName'] =$this->contractType -> where(array('CttTypeID' => array('in',$res['CttTypeID']))) -> getField('CttTypeName');

        $res['ShortName'] = $this->customer ->where(array('Identifier'=>$res['Identifier'])) -> getfield('ShortName');
        //对内容进行处理
        $res['Introduce'] = htmlspecialchars_decode($res['Introduce']);
       // $res['Introduce'] = strip_tags($res['Introduce']);
        $this -> assign('info',$res);
        $this -> display();

    }

    //收款计划
    public function plan(){

        if(IS_POST){
            $type= i('type');
            switch($type){
                case 1:
                    $data = i('post.');
                    unset($data['type']);
                    $data['CreateTime'] = date('Y-m-d H:i:s');
                    M('collectionplan') -> add($data);
                    $this -> success('添加成功');
                    break;
                case 2:
                    $info = i('post.');
                    $where['PlanID'] = I('cid');
                    $data[$info['name']] = $info['value'];
                    M('collectionplan') -> where($where) -> save($data);
                    $this -> success('修改成功');
                    break;
                case 3:
                    $cid = i('cid');
                    $data['DelFlag'] = 1;
                    M('collectionplan') -> where(array('PlanID' => $cid)) -> save($data);
                    $this -> success('删除成功');
                    break;
            }
        }else{
            $where['DelFlag'] = 0;
            $where['ContractID'] = I('id');
            $info =  M('collectionplan') -> where($where) -> order('PlanTime asc') ->select();
            $this -> assign('infos',$info);
            $this -> display();
        }
    }
    public function statistics(){
        $this->display();
    }

    public function loadStatistics(){
        //市场部数据统计 1003
        /*
        $cond["E.DepartmentNum"] = "1001";
        $cond["C.Sources"] = 1;//1 直营
        $cond["C.DelFlag"] =0;
        $subSql = $this->emp->alias("E")->join("customer C on C.DeveloperID = E.EmployeeID","left")
            ->field("E.EmployeeID,E.Name,C.Identifier")->where($cond)->buildSql();
        $test = M("")->table($subSql." A")->select();
        print_r($test);
        $map["B.DelFlag"] = 0;
        $info = M("")->table($subSql . " A")->join("market B on B.Identifier = A.Identifier and B.EmpID = A.EmployeeID and B.DelFlag = 0","left")
            ->field("A.*,count(B.MarketID) as MarketNum")->group("A.EmployeeID,A.Identifier")->select();
        print_r($info);
        */
    }
    //查看市场记录
    public function seeMarket(){

        $id = i('id');
        $where['MarketID'] = $id;

        $res = $this -> market -> where($where) -> find();
        //客户
        $res['customerName'] = M('customer') -> where(array('Identifier' => $res['Identifier'])) -> getField('ShortName');
        //跟进人
        $res['empName'] = M('employee') -> where(array('EmployeeID' => $res['EmpID'])) -> getField('Name');
        //协同人
        $res['coopName'] = $res['CoopPerson']?M('employee') -> where(array('EmployeeID' => $res['CoopPerson'])) -> getField('Name'):'无协同人';
        //客户状态
        $state = M('customer') -> where(array('Identifier' => $res['Identifier'])) -> getField('CtmStatusID');
        $res['stateName'] = $state?M('customerstatus') -> where(array('CtmStatusID' => $state)) -> getField('CtmStatusName'):'暂无状态';

        $this -> assign('info',$res);

        $this -> display();


    }


    /**
     * 获取返回时的签名验证结果
     * @param $para_temp 通知返回来的参数数组
     * @param $sign 返回的签名结果
     * @return 签名验证结果
     */
    function getSignVeryfy($para_temp, $sign) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $isSgin = $this->md5Verify($prestr, $sign, $this->app_secret);

        return $isSgin;
    }

    /**
     * 签名字符串
     * @param $prestr 需要签名的字符串
     * @param $key 私钥
     * return 签名结果
     */
    function md5Sign($prestr, $key) {
        $prestr = $key . $prestr . $key;
        return md5($prestr);
    }

    /**
     * 验证签名
     * @param $prestr 需要签名的字符串
     * @param $sign 签名结果
     * @param $key 私钥
     * return 签名结果
     */
    function md5Verify($prestr, $sign, $key) {
        $prestr = $key .$prestr . $key;
        $mysgin = md5($prestr);

        if(strtolower($mysgin) == strtolower($sign)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    function createLinkstring($para) {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            //$arg.=$key."=".$val."&";
            $arg.=$key.$val;
        }
        //去掉最后一个&字符
        //$arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        //if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para 签名参数组
     * return 去掉空值与签名参数后的新签名参数组
     */
    function paraFilter($para) {
        $para_filter = array();
        while (list ($key, $val) = each ($para)) {
            if($key == "sign" || $key == "sign_type" || $val == "")continue;
            else	$para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }
    /**
     * 对数组排序
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    function argSort($para) {
        $para = kicsort($para);
        reset($para);
        return $para;
    }


}