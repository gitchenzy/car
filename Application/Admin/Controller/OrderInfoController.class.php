<?php
/**
 * Created by PhpStorm.
 * User: Huge
 * Date: 2016/3/5 0005
 * Time: 14:00
 */

namespace Admin\Controller;


class OrderInfoController extends AdminController
{

    protected function _initialize(){
        parent::_initialize();

    }
    public function index(){
        $this->assign("crumbs_title","财务信息");
        $this->display();
    }
    //加载财务记录
    public function loadOrder(){
        $search_value = i('search');
        $offset = i("offset");
        $limit = i("limit");
        if($search_value){
            $where['Receipt'] = array('like',"%$search_value%");
        }
        $where['DelFlag'] = 0;
        $count = M('orderinfo') -> where($where) -> count();
        $info = M('orderinfo') -> where($where) -> limit($offset,$limit) -> select();
        foreach($info as &$v){
            $v['CustomerName'] =M('customer') -> where(array('CustomerID' => $v['CustomerID'])) -> getField('FullName');
            $v['ProductName'] =M('product') -> where(array('ProductID' => $v['ProductID'])) -> getField('ProductName');
            $v['PayName'] =M('paytype') -> where(array('PayID' => $v['PayType'])) -> getField('PayName');
            $v['StatusName'] = $v['Status'] == 1?'已付款':'未付款';
        }

       // $list_array= $info?$info:array();
        $list_array= array("total"=>$count,"rows"=>$info?$info:array());
        echo json_encode($list_array);
    }
    //添加财务记录
    public function addOrder(){
        if(IS_POST){
            $data = i('post.');
            $data['PayTime'] = date('Y-m-d H:i:s');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            M('orderinfo') -> add($data);
            $this -> success('添加成功！');
        }else{
            $where['DelFlag']=0;
            //选择客户
            $cInfo = M('customer') -> where($where) -> getField("CustomerID,FullName");
            //产品信息
            $product = M('product') -> where($where) -> getField("ProductID,ProductName");
            //支付方式
            $paytype = M('paytype') -> where($where) -> getField("PayID,PayName");
            $this -> assign('product',$product);
            $this -> assign('cInfo',$cInfo);
            $this -> assign('paytype',$paytype);
            $this -> display('editOrder');
        }
    }
    //修改编辑财务记录
    public function editOrder(){
        $id = i('id');
        if(IS_POST){
            $where['OrderID']=$id;
            $data = i('post.');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $info = M('orderinfo') -> where($where) -> save($data);
            $this -> success('编辑成功！');
        }else{
            $where['DelFlag']=0;
            //选择客户
            $cInfo = M('customer') -> where($where) ->  getField("CustomerID,FullName");
            //产品信息
            $product = M('product') -> where($where) -> getField("ProductID,ProductName");
            //支付方式
            $paytype = M('paytype') -> where($where) -> getField("PayID,PayName");
            $where['OrderID'] = $id;
            $info = M('orderinfo') -> where($where) -> find();
            $this -> assign('info',$info);
            $this -> assign('product',$product);
            $this -> assign('paytype',$paytype);
            $this -> assign('cInfo',$cInfo);
            $this -> display();
        }
    }
    //删除财务记录
    public function delOrder(){
        $array_id['OrderID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        M('orderinfo') -> where($array_id) -> save($data);
        $this -> success('删除成功！');

    }






















}
