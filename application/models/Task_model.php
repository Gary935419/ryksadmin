<?php


class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //任务count
    public function gettaskAllPage($tatitle)
    {
        $sqlw = " where 1=1 ";
        if (!empty($tatitle)) {
            $sqlw .= " and ( u.tatitle like '%" . $tatitle . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `task` u left join `taskclass` r on u.tid=r.tid " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //任务list
    public function gettaskAllNew($pg,$tatitle)
    {
        $sqlw = " where 1=1 ";
        if (!empty($tatitle)) {
            $sqlw .= " and ( u.tatitle like '%" . $tatitle . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT u.*,r.tname FROM `task` u left join `taskclass` r on u.tid=r.tid " . $sqlw . " order by u.add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //类型list
    public function gettidlist()
    {
        $sql = "SELECT * FROM `taskclass` order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //标签list
    public function getlaidslist()
    {
        $sql = "SELECT * FROM `label` order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //任务byname
    public function gettaskByname($tatitle)
    {
        $tatitle = $this->db->escape($tatitle);
        $sql = "SELECT * FROM `task` where tatitle=$tatitle ";
        return $this->db->query($sql)->row_array();
    }
    //任务save
    public function task_save($taurl,$requirement,$tatips,$tacontents,$tid, $tanums,$tacommission,$laids,$tatitle,$taimg,$if_recommend,$constraintdays,$tadays,$examinedays,$tadeposit,$taintegral,$add_time,$taid)
    {
        $tid = $this->db->escape($tid);
        $tanums = $this->db->escape($tanums);
        $tacommission = $this->db->escape($tacommission);
        $laids = $this->db->escape($laids);
        $tatitle = $this->db->escape($tatitle);
        $taimg = $this->db->escape($taimg);
        $if_recommend = $this->db->escape($if_recommend);
        $constraintdays = $this->db->escape($constraintdays);
        $tadays = $this->db->escape($tadays);
        $examinedays = $this->db->escape($examinedays);
        $tadeposit = $this->db->escape($tadeposit);
        $taintegral = $this->db->escape($taintegral);
        $add_time = $this->db->escape($add_time);
        $taid = $this->db->escape($taid);
        $requirement = $this->db->escape($requirement);
        $tatips = $this->db->escape($tatips);
        $tacontents = $this->db->escape($tacontents);
        $taurl = $this->db->escape($taurl);
        $sql = "INSERT INTO `task` (taurl,requirement,tatips,tacontents,tid, tanums,tacommission,laids,tatitle,taimg,if_recommend,constraintdays,tadays,examinedays,tadeposit,taintegral,add_time,taid) VALUES ($taurl,$requirement,$tatips,$tacontents,$tid, $tanums,$tacommission,$laids,$tatitle,$taimg,$if_recommend,$constraintdays,$tadays,$examinedays,$tadeposit,$taintegral,$add_time,$taid)";
        return $this->db->query($sql);
    }
    //任务delete
    public function task_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM task WHERE taid = $id";
        return $this->db->query($sql);
    }
    //任务byid
    public function gettaskById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `task` where taid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //等级byid
    public function getgradeById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `grade` where gid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //设置byid
    public function getsetById()
    {
        $sql = "SELECT * FROM `setting` where sid=1 ";
        return $this->db->query($sql)->row_array();
    }
    //任务byname id
    public function gettaskById2($tatitle, $taid)
    {
        $tatitle = $this->db->escape($tatitle);
        $taid = $this->db->escape($taid);
        $sql = "SELECT * FROM `task` where tatitle=$tatitle and taid!=$taid ";
        return $this->db->query($sql)->row_array();
    }
    //任务save_edit
    public function task_save_edit($taurl,$requirement,$tatips,$tacontents,$tid, $tanums,$tacommission,$laidsnew,$tatitle,$taimg,$if_recommend,$constraintdays,$tadays,$examinedays,$tadeposit,$taintegral,$add_time,$taid)
    {
        $tid = $this->db->escape($tid);
        $tanums = $this->db->escape($tanums);
        $tacommission = $this->db->escape($tacommission);
        $laids = $this->db->escape($laidsnew);
        $tatitle = $this->db->escape($tatitle);
        $taimg = $this->db->escape($taimg);
        $if_recommend = $this->db->escape($if_recommend);
        $constraintdays = $this->db->escape($constraintdays);
        $tadays = $this->db->escape($tadays);
        $examinedays = $this->db->escape($examinedays);
        $tadeposit = $this->db->escape($tadeposit);
        $taintegral = $this->db->escape($taintegral);
        $taid = $this->db->escape($taid);
        $requirement = $this->db->escape($requirement);
        $tatips = $this->db->escape($tatips);
        $tacontents = $this->db->escape($tacontents);
        $taurl = $this->db->escape($taurl);
        $sql = "UPDATE `task` SET tid=$tid,tanums=$tanums,tacommission=$tacommission,laids=$laids,tatitle=$tatitle,taimg=$taimg,if_recommend=$if_recommend,constraintdays=$constraintdays,tadays=$tadays,examinedays=$examinedays,tadeposit=$tadeposit,taintegral=$taintegral,requirement=$requirement,tatips=$tatips,tacontents=$tacontents,taurl=$taurl WHERE taid = $taid";
        return $this->db->query($sql);
    }

    //memberwallet_save_edit
    public function memberwallet_save_edit($walletnew,$mid)
    {
        $walletnew = $this->db->escape($walletnew);
        $mid = $this->db->escape($mid);

        $sql = "UPDATE `member` SET wallet=$walletnew WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //tasktanums_save_edit
    public function tasktanums_save_edit($tanumsnew,$taid)
    {
        $tanumsnew = $this->db->escape($tanumsnew);
        $taid = $this->db->escape($taid);

        $sql = "UPDATE `task` SET tanums=$tanumsnew WHERE taid = $taid";
        return $this->db->query($sql);
    }
    //taskorder_save
    public function taskorder_save($otaurl,$olaids,$taid,$mid,$otid,$otanums,$otacontents,$otacommission, $otatitle,$otaimg,$oif_recommend,$otatips,$oconstraintdays,$otadays,$otadeposit,$oexaminedays,$orequirement,$otaintegral,$add_time,$ostate)
    {
        $otaurl = $this->db->escape($otaurl);
        $olaids = $this->db->escape($olaids);
        $taid = $this->db->escape($taid);
        $mid = $this->db->escape($mid);
        $otid = $this->db->escape($otid);
        $otanums = $this->db->escape($otanums);
        $otacontents = $this->db->escape($otacontents);
        $otacommission = $this->db->escape($otacommission);
        $otatitle = $this->db->escape($otatitle);
        $otaimg = $this->db->escape($otaimg);
        $oif_recommend = $this->db->escape($oif_recommend);
        $otatips = $this->db->escape($otatips);
        $oconstraintdays = $this->db->escape($oconstraintdays);
        $otadays = $this->db->escape($otadays);
        $otadeposit = $this->db->escape($otadeposit);
        $oexaminedays = $this->db->escape($oexaminedays);
        $orequirement = $this->db->escape($orequirement);
        $otaintegral = $this->db->escape($otaintegral);
        $add_time = $this->db->escape($add_time);
        $ostate = $this->db->escape($ostate);

        $sql = "INSERT INTO `taorder` (otaurl,olaids,taid,mid,otid,otanums,otacontents,otacommission, otatitle,otaimg,oif_recommend,otatips,oconstraintdays,otadays,otadeposit,oexaminedays,orequirement,otaintegral,add_time,ostate) VALUES ($otaurl,$olaids,$taid,$mid,$otid,$otanums,$otacontents,$otacommission, $otatitle,$otaimg,$oif_recommend,$otatips,$oconstraintdays,$otadays,$otadeposit,$oexaminedays,$orequirement,$otaintegral,$add_time,$ostate)";
        $this->db->query($sql);
        $oid=$this->db->insert_id();
        return $oid;
    }
    //taskwater_save
    public function taskwater_save($mid,$wremark,$wprice,$wtype,$add_time)
    {
        $mid = $this->db->escape($mid);
        $wremark = $this->db->escape($wremark);
        $wprice = $this->db->escape($wprice);
        $wtype = $this->db->escape($wtype);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `walletwater` (mid,wremark,wprice,wtype,add_time) VALUES ($mid,$wremark,$wprice,$wtype,$add_time)";
        return $this->db->query($sql);
    }
    //获取会员接该任务次数
    public function gettaskordercount($taid,$mid)
    {
        $taid = $this->db->escape($taid);
        $mid = $this->db->escape($mid);
        $sqlw = " where 1=1 and mid =$mid and taid=$taid";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //taskorderById
    public function gettaskorderById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `taorder` where oid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //gettaskorderlist
    public function gettaskorderlist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid order by add_time desc ";

        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `taorder` " . $sqlw ." LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
    //gettaskorderlist1
    public function gettaskorderlist1($mid,$pg)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=1 order by add_time desc ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `taorder` " . $sqlw ." LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //gettaskorderlist2
    public function gettaskorderlist2($mid,$pg)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=2 order by add_time desc ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `taorder` " . $sqlw ." LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //gettaskorderlist3
    public function gettaskorderlist3($mid,$pg)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=3 order by add_time desc ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `taorder` " . $sqlw ." LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //gettaskorderlist4
    public function gettaskorderlist4($mid,$pg)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=4 order by add_time desc ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `taorder` " . $sqlw ." LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //商检入驻 资质图片保存
    public function taskexamineimg_save($oid,$oiimg)
    {
        $oid = $this->db->escape($oid);
        $oiimg = $this->db->escape($oiimg);
        $sql = "INSERT INTO `oimgs` (oid,oiimg) VALUES ($oid,$oiimg)";
        return $this->db->query($sql);
    }
    //商检入驻 审核信息保存
    public function shoptaskorder_save($mid,$content,$address,$email,$shopname,$mobile,$truename,$ostate,$add_time)
    {
        $content = $this->db->escape($content);
        $address = $this->db->escape($address);
        $email = $this->db->escape($email);
        $shopname = $this->db->escape($shopname);
        $mobile = $this->db->escape($mobile);
        $truename = $this->db->escape($truename);
        $add_time = $this->db->escape($add_time);
        $ostate = $this->db->escape($ostate);

        $sql = "INSERT INTO `taorder` (mid,content,address,email,shopname,mobile,truename,ostate,add_time) VALUES ($mid,$content,$address,$email,$shopname,$mobile,$truename,$ostate,$add_time)";
        $this->db->query($sql);
        $oid=$this->db->insert_id();
        return $oid;
    }
    //审核任务状态
    public function updatataskorderexamine($mid,$oid,$description,$ostate,$eadd_time)
    {
        $mid = $this->db->escape($mid);
        $oid = $this->db->escape($oid);
        $description = $this->db->escape($description);
        $ostate = $this->db->escape($ostate);
        $eadd_time = $this->db->escape($eadd_time);

        $sql = "UPDATE `taorder` SET description=$description,ostate=$ostate,eadd_time=$eadd_time WHERE oid = $oid and mid = $mid ";
        return $this->db->query($sql);
    }
    //获取提现申请列表
    public function withdrawallist($mid,$wtype,$pg)
    {
        $mid = $this->db->escape($mid);
        $wtype = $this->db->escape($wtype);
        $sqlw = " where 1=1 and mid = $mid and wtype = $wtype ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `withdrawal` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //审核任务截图
    public function withdrawalwrprice($wtype,$mid,$wrprice,$wrstate,$add_time)
    {
        $mid = $this->db->escape($mid);
        $wrprice = $this->db->escape($wrprice);
        $wrstate = $this->db->escape($wrstate);
        $add_time = $this->db->escape($add_time);
        $wtype = $this->db->escape($wtype);
        $sql = "INSERT INTO `withdrawal` (wtype,mid,wrprice,wrstate,add_time) VALUES ($wtype,$mid,$wrprice,$wrstate,$add_time)";
        return $this->db->query($sql);
    }
    //押金余额提现扣款
    public function updatawithdrawalwrprice($mid,$walletnew)
    {
        $mid = $this->db->escape($mid);
        $walletnew = $this->db->escape($walletnew);
        $sql = "UPDATE `member` SET wallet=$walletnew WHERE  mid = $mid ";
        return $this->db->query($sql);
    }
    //佣金余额提现扣款
    public function updatawithdrawalwrpricecom($mid,$walletcommissionnew)
    {
        $mid = $this->db->escape($mid);
        $walletcommissionnew = $this->db->escape($walletcommissionnew);
        $sql = "UPDATE `member` SET walletcommission=$walletcommissionnew WHERE  mid = $mid ";
        return $this->db->query($sql);
    }
    //getsettinginfo
    public function getsettinginfo()
    {
        $sql = "SELECT * FROM `setting` where sid=1 ";
        return $this->db->query($sql)->row_array();
    }
    //rechargeordersave
    public function rechargeordersave($recommend,$money,$mid,$remarks,$pstate,$rtype,$paynumber,$add_time)
    {
        $recommend = $this->db->escape($recommend);
        $mid = $this->db->escape($mid);
        $remarks = $this->db->escape($remarks);
        $pstate = $this->db->escape($pstate);
        $rtype = $this->db->escape($rtype);
        $paynumber = $this->db->escape($paynumber);
        $add_time = $this->db->escape($add_time);
        $money = $this->db->escape($money);
        $sql = "INSERT INTO `rechargeorder` (recommend,money,mid,remarks,pstate,rtype,paynumber,add_time) VALUES ($recommend,$money,$mid,$remarks,$pstate,$rtype,$paynumber,$add_time)";
        return $this->db->query($sql);
    }
    //updatarechargeorder
    public function updatarechargeorder($paynumber)
    {
        $paynumber = $this->db->escape($paynumber);

        $sql = "UPDATE `rechargeorder` SET pstate=1 WHERE  paynumber = $paynumber ";
        return $this->db->query($sql);
    }
    //rechargeorderinfo
    public function rechargeorderinfo($paynumber)
    {
        $paynumber = $this->db->escape($paynumber);
        $sql = "SELECT * FROM `rechargeorder` where paynumber=$paynumber ";
        return $this->db->query($sql)->row_array();
    }
    //memberinfo
    public function memberinfo($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "SELECT * FROM `member` where mid=$mid ";
        return $this->db->query($sql)->row_array();
    }
    //updatamemberinfowallet
    public function updatamemberinfowallet($mid,$walletnew)
    {
        $mid = $this->db->escape($mid);
        $walletnew = $this->db->escape($walletnew);
        $sql = "UPDATE `member` SET wallet=$walletnew WHERE  mid = $mid ";
        return $this->db->query($sql);
    }
    //修改已经交押金会员状态
    public function updatamemberifpay($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "UPDATE `member` SET ifpay=1 WHERE  mid = $mid ";
        return $this->db->query($sql);
    }
    //钱包明细save
    public function wallet_water_save($wprice,$add_time,$mid,$wtype,$wremark)
    {
        $wprice = $this->db->escape($wprice);
        $add_time = $this->db->escape($add_time);
        $mid = $this->db->escape($mid);
        $wtype = $this->db->escape($wtype);
        $wremark = $this->db->escape($wremark);
        $sql = "INSERT INTO `walletwater` (wprice,add_time,mid,wtype,wremark) VALUES ($wprice,$add_time,$mid,$wtype,$wremark)";
        return $this->db->query($sql);
    }

    //押金已经充值数量
    public function getrechargeordercount($member_id,$badd_time)
    {
        $sqlw = " where recommend=$member_id and pstate=1 and $badd_time>=add_time GROUP BY mid";
        $sql = "SELECT count(1) as number FROM `rechargeorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }

    //updatashare
    public function updatashare($mid,$member_id,$badd_time)
    {
        $mid = $this->db->escape($mid);
        $member_id = $this->db->escape($member_id);
        $badd_time = $this->db->escape($badd_time);
        $sql = "UPDATE `member` SET member_id=$member_id,badd_time=$badd_time WHERE  mid = $mid ";
        return $this->db->query($sql);
    }

    //获取商品列表
    public function goodslist($keywords,$pg)
    {
        $sqlw = " where 1=1 ";
        if (!empty($keywords)) {
            $sqlw .= " and ( gname like '%" . $keywords . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `goods` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取商品列表 推荐
    public function goodsliststatus($keywords,$pg,$status)
    {
        $sqlw = " where 1=1 and status = $status ";
        if (!empty($keywords)) {
            $sqlw .= " and ( gname like '%" . $keywords . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `goods` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取商品列表类型
    public function goodslisttype($tid,$pg)
    {
        $sqlw = " where tid=$tid ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `goods` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取商品详情
    public function goodsdetails($gid)
    {
        $gid = $this->db->escape($gid);
        $sql = "SELECT * FROM `goods` where gid=$gid ";
        return $this->db->query($sql)->row_array();
    }

    //获取商品banner列表
    public function goodsimglist($gid)
    {
        $gid = $this->db->escape($gid);
        $sqlw = " where 1=1 and gid = $gid";
        $sql = "SELECT * FROM `gimgs` " . $sqlw ;
        return $this->db->query($sql)->result_array();
    }

    //避免重复点击
    public function getordergoodsByIdstate($gid,$mid,$timeon)
    {
        $gid = $this->db->escape($gid);
        $sql = "SELECT * FROM `ordergoods` where gid=$gid and mid=$mid and addtime>=$timeon ";
        return $this->db->query($sql)->row_array();
    }
    //兑换商品积分结算
    public function member_save_edit1($mid, $integralnew)
    {
        $mid = $this->db->escape($mid);
        $integralnew = $this->db->escape($integralnew);
        $sql = "UPDATE `member` SET integral=$integralnew WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //积分明细save
    public function integralflow_save($integral,$add_time1,$mid,$ftype,$fremark)
    {
        $integral = $this->db->escape($integral);
        $add_time1 = $this->db->escape($add_time1);
        $mid = $this->db->escape($mid);
        $ftype = $this->db->escape($ftype);
        $fremark = $this->db->escape($fremark);
        $sql = "INSERT INTO `integralflow` (integral,add_time,mid,ftype,fremark) VALUES ($integral,$add_time1,$mid,$ftype,$fremark)";
        return $this->db->query($sql);
    }
    //修改商品库存
    public function goods_edit1($gid, $gstocknew)
    {
        $gid = $this->db->escape($gid);
        $gstocknew = $this->db->escape($gstocknew);
        $sql = "UPDATE `goods` SET gstock=$gstocknew WHERE gid = $gid";
        return $this->db->query($sql);
    }
    //商家合作意向
    public function flowgoods_save($gname,$gtitle,$gcontent,$gimg,$addtime,$ostate,$gsort,$gid,$mid,$content,$email,$shopname,$mobile,$truename)
    {
        $gname = $this->db->escape($gname);
        $gtitle = $this->db->escape($gtitle);
        $gcontent = $this->db->escape($gcontent);
        $content = $this->db->escape($content);
        $email = $this->db->escape($email);
        $shopname = $this->db->escape($shopname);
        $mobile = $this->db->escape($mobile);
        $truename = $this->db->escape($truename);
        $gimg = $this->db->escape($gimg);
        $addtime = $this->db->escape($addtime);
        $ostate = $this->db->escape($ostate);
        $gsort = $this->db->escape($gsort);
        $gid = $this->db->escape($gid);
        $mid = $this->db->escape($mid);
        $sql = "INSERT INTO `ordergoods` (gname,gtitle,gcontent,gimg,addtime,ostate,gsort,gid,mid,content,email,shopname,mobile,truename) VALUES ($gname,$gtitle,$gcontent,$gimg,$addtime,$ostate,$gsort,$gid,$mid,$content,$email,$shopname,$mobile,$truename)";
        return $this->db->query($sql);
    }
    //获取我的兑换商品列表
    public function mygoodslist($pg,$mid)
    {
        $mid = $this->db->escape($mid);
        $sqlw = " where 1=1 and mid=$mid ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `ordergoods` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //商家入驻 图片
    public function gettaskorderimglist($oid)
    {
        $oid = $this->db->escape($oid);
        $sql = "SELECT * FROM `oimgs` WHERE oid = $oid ";
        return $this->db->query($sql)->result_array();
    }
    //获取会员当天申请次数
    public function getshopscount($mid,$todayStart,$todayEnd)
    {
        $sqlw = " where 1=1 and mid = $mid and add_time between $todayStart and $todayEnd ";
        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员当天申请次数
    public function getshopscountgoods($mid,$todayStart,$todayEnd)
    {
        $sqlw = " where 1=1 and mid = $mid and addtime between $todayStart and $todayEnd ";
        $sql = "SELECT count(1) as number FROM `ordergoods` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
}