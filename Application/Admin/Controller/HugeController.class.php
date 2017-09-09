<?php
/**
 * Created by PhpStorm.
 * User: Huge
 * Date: 2016/3/15 0015
 * Time: 16:16
 */

namespace Admin\Controller;

use Think\Log;

class HugeController
{
    protected function _initialize(){
        parent::_initialize();
    }

    public function index(){
        $this->display();
    }

    public function modal(){
        $this->display();
    }
    public function remoteSuccess(){
        Log::record("remote Access" , Log::INFO);
        $data=i("post.");

        if($data["Status"]==1){
            $cond["CustomerID"] = $data["CustomerID"];
            $saveInfo["OpenTime"] = time_format();
            $saveInfo["Status"] = 1;

            //    $allUser = M("employee_duty")->where(array("DutyID"=>20,"Type"=>1))->getField("MemberID",true);
            //   $key = array_rand($allUser,1);
            //   $saveInfo["ServicesID"] = $allUser[$key];

            $result = M("sop")->where($cond)->save($saveInfo);
            if($result){  //ERP开通后更新成功
                $receiveUser = M("sop")->field("MarketID,ServicesID,EmployeeID,ForceID")->where($cond)->find();
                foreach($receiveUser as $ru => $u){
                    if(!empty($u)){
                        $tempEmail = M("employee")->where(array("EmployeeID"=>$u))->getField("Email");
                        $EmailContent = "客户编号为".$cond["CustomerID"]."的系统已经开通成功，敬请关注后续流程！";
                        sendEmail($tempEmail,'系统开通成功！',$EmailContent);
                    }
                }
            }
        }
    }

}