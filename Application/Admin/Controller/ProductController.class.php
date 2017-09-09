<?php
/**
 * Created by PhpStorm.
 * User: Huge
 * Date: 2016/3/5 0005
 * Time: 14:00
 */

namespace Admin\Controller;


class ProductController extends AdminController
{
    private $Product,$emp;
    protected function _initialize(){
        parent::_initialize();
        $this -> Product = M('product');
        $this -> emp = M('employee');
    }
    public function index(){
        $this->display();
    }
    //加载产品信息
    public function loadProduct(){
        $value = i('search');
        $offset = i("offset");
        $limit = i("limit");
        $where['DelFlag'] = 0;
        if($value){
            $where['ProductName'] = array('LIKE',"%$value%");
        }

        $count = $this->Product -> where($where) -> order('Sort desc') -> count();
        $res = $this->Product -> where($where) -> limit($offset,$limit) -> order('Sort desc') -> select();
        foreach($res as &$v){
            $v['OperatorName'] =$this->emp -> where(array('EmployeeID' => $v['OperatorID'])) -> getField('Name');
        }
        $list_array= array("total"=>$count,"rows"=>$res?$res:array());
        echo json_encode($list_array);
    }
    //新增产品信息
    public function addProduct(){
        if(IS_POST){
            $data = i('post.');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $this->Product -> add($data);
            $this->success('增加成功！');
        }else{
            $this-> display('editProduct');
        }
    }
    //修改产品信息
    public function editProduct(){
        $id = i('id');
        $where['ProductID'] = $id;
        $where['DelFlag'] = 0;
        if(IS_POST){
            $data = i('post.');
            $data['ModifyTime'] = date('Y-m-d H:i:s');
            $data['OperatorID'] = $this->user['EmployeeID'];
            $this -> Product -> where($where) -> save($data);
            $this->success('修改成功！');
        }else{
            $res = $this-> Product -> where($where)-> find();
            $this->assign('info',$res);
            $this-> display();
        }
    }
    //删除产品信息
    public function delProduct(){
        $array_id['ProductID'] = array('in',$_POST['ids']);
        $data['DelFlag'] = 1;
        $data['ModifyTime'] = date('Y-m-d H:i:s');
        $data['OperatorID'] = $this->user['EmployeeID'];
        $this -> Product -> where($array_id) -> save($data);
        $this -> success('删除成功！');
    }

























}
