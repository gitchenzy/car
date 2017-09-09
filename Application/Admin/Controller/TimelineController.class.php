<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/23 0023
 * Time: 16:49
 */
namespace Admin\Controller;


class TimelineController extends AdminController
{
    protected function _initialize(){
        AdminController::$allow_login[] = 'admin/timeline/index';
    }

    public function index() {

        $user_id = intval(i('id'));
        if (empty($user_id)) {
            $user_id = get_user_id();
        }

        //
        $feedback_original = M('feedback')
            ->alias("f")
            ->field("f.*,c.ShortName")
            ->join("customer c on f.CustomerID=c.CustomerID")
            ->where(array('f.EmpID' => $user_id , 'f.DelFlag' => 0 , 'f.FbStatusID' => array('in' , array(1, 4))))
            ->order('f.PlanTime asc')
            ->select();

        //feedback dictionary
        $feedback_list = array();
        foreach($feedback_original as $feedback) {
            $plan_date = time_format(strtotime($feedback['PlanTime']) , "Y-m-d");
            $plan_time = strtotime($plan_date);
            $current_date_time = strtotime(time_format(time(), "Y-m-d"));
            if ($plan_time == $current_date_time) {
                $feedback['css_class'] = "item-warning";
            }
            else if ($plan_time < $current_date_time){
                $feedback['css_class'] = "item-danger";
            }
            $feedback_list[$plan_date][] = $feedback;
        }
        $this->feedback_list = $feedback_list;
        $this->display();
    }
}