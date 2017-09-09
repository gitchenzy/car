<?php
namespace Admin\Controller;
use Think\Controller;

class AutoSendEmailController extends Controller {

	//定点访问。每天汇总bug跟需求给研发负责人 时间是空间的纬度。每时每刻，我们都在前进，前进的我们都在消耗我们的生命。想看到过去也不难，有本事你就逆着走，就能找到过去
	public function getBug(){
		//汇总前一天到现在的bug还没有分配的，和已经受理的需求
		//获取前一天
		$time = time() - 24*60*60;
		$a = date('Y-m-d H:i:s',$time);//前一天的时间
		$b = date('Y-m-d H:i:s',time());
		$where['FbTime'] = array('GT',$a);
		$where['FbTime'] = array('LT',$b);
		$where['allotted'] = 0;
		$where['FbStatusID'] = 1;
		$where['DelFlag'] = 0;
		$res = M('feedback') -> where($where) -> select();
		//编辑邮件内容
		$content ='<style>
			body{}
			td{margin:0px;padding:5px;background:#ccc;}
		</style>';
		$content .= '<table border="1" cellspacing="1"> <tr><th>编号</th><th>标题</th><th>内容</th></tr>';
		$zhengz = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
		if($res){
			foreach($res as $v){
				$v['Description'] = htmlspecialchars_decode($v['Description']);
				//过滤掉内容的图片
				$v['Description'] = preg_replace($zhengz,'',$v['Description']);
				$v['Description'] = msubstr($v['Description'],0,20);
				$content .= "<tr><td>{$v['FeedbackID']}</td><td>{$v['Title']}</td><td>".strip_tags($v['Description'])."</td></tr>";
			}
			$content .= '</table>';
			$title = '今日汇总的bug以及需求!';
			//查出研发负责人
			$data['DepartmentNum'] = 3;
			$data['isPriority'] = 1;
			$data['DelFlag'] = 0;
			$pen = M('employee') -> field('Email') ->where($data) -> select();
			foreach($pen as $p){
				sendEmail($p['Email'],$title,$content);
			}
		}

	}

	//汇总所有的需求给产品经理
	public function getNeed(){
		$where['FBtype'] = 1;
		$where['FbStatusID'] = 1;
		$where['allotted'] = 0;
		$where['DelFlag'] = 0;
		$where['Accept'] = array('EXP','is null');
		$result = M('feedback') -> where($where) -> select();
		$content ='<style>
			body{}
			td{margin:0px;padding:5px;background:#ccc;}
		</style>';
		$content .= '<table border="1" cellspacing="1"> <tr><th>编号</th><th>标题</th><th>内容</th></tr>';
		$title = '有新的需求啦，请上crm受理新需求！';
		$zhengz = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
		if($result){
			foreach($result as $v){
				$v['Description'] = htmlspecialchars_decode($v['Description']);
				//过滤掉内容的图片
				$v['Description'] = preg_replace($zhengz,'',$v['Description']);
				$v['Description'] = msubstr($v['Description'],0,20);

				$content .= "<tr><td>{$v['FeedbackID']}</td><td>{$v['Title']}</td><td>".strip_tags($v['Description'])."</td></tr>";
			}
			$content .= '</table>';
			//  echo $content;
			//查询产品负责人
			$data['DepartmentNum'] = 7;
			$data['isPriority'] = 1;
			$data['DelFlag'] = 0;
			$pen = M('employee') -> field('Email') ->where($data) -> select();
			foreach($pen as $p){
				sendEmail($p['Email'],$title,$content);
			}
		}
	}


}