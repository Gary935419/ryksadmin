<?php


class Goods_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //商品count
    public function getgoodsAllPage($gname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($gname)) {
            $sqlw .= " and ( gname like '%" . $gname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `goods`" . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //商品list
    public function getgoodsAllNew($pg,$gname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($gname)) {
            $sqlw .= " and ( gname like '%" . $gname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `goods` " . $sqlw . " order by gsort desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //商品图片list
    public function getgoodsimgsAllNew($gid)
    {
        $gid = $this->db->escape($gid);
        $sqlw = " where 1=1 and gid = $gid";
        $sql = "SELECT * FROM `gimgs` " . $sqlw;
        return $this->db->query($sql)->result_array();
    }
    //商品byname
    public function getgoodsByname($gname)
    {
        $gname = $this->db->escape($gname);
        $sql = "SELECT * FROM `goods` where gname=$gname ";
        return $this->db->query($sql)->row_array();
    }
    //商品save
    public function goods_save($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status)
    {
        $gname = $this->db->escape($gname);
        $gtitle = $this->db->escape($gtitle);
        $tid = $this->db->escape($tid);
        $gsort = $this->db->escape($gsort);
        $gimg = $this->db->escape($gimg);
        $gcontent = $this->db->escape($gcontent);
        $addtime = $this->db->escape($addtime);
        $status = $this->db->escape($status);
        $sql = "INSERT INTO `goods` (status,gname, gtitle,tid,gsort,gimg,gcontent,addtime) VALUES ($status,$gname, $gtitle,$tid,$gsort,$gimg,$gcontent,$addtime)";
        $this->db->query($sql);
        $gid=$this->db->insert_id();
        return $gid;
    }
    //商品bannersave
    public function goodsimg_save($gid,$imgs)
    {
        $gid = $this->db->escape($gid);
        $imgs = $this->db->escape($imgs);
        $sql = "INSERT INTO `gimgs` (gid,imgs) VALUES ($gid,$imgs)";
        return $this->db->query($sql);;
    }
    //商品delete
    public function goods_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM goods WHERE gid = $id";
        return $this->db->query($sql);
    }
    //商品图片delete
    public function goodsimg_delete($gid)
    {
        $gid = $this->db->escape($gid);
        $sql = "DELETE FROM gimgs WHERE gid = $gid";
        return $this->db->query($sql);
    }
    //商品byid
    public function getgoodsById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `goods` where gid=$id ";
        return $this->db->query($sql)->row_array();
    }

    //商品byname id
    public function getgoodsById2($gname, $gid)
    {
        $gname = $this->db->escape($gname);
        $gid = $this->db->escape($gid);
        $sql = "SELECT * FROM `goods` where gname=$gname and gid!=$gid ";
        return $this->db->query($sql)->row_array();
    }
    //商品save_edit
    public function goods_save_edit($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status)
    {
        $gid = $this->db->escape($gid);
        $gname = $this->db->escape($gname);
        $gtitle = $this->db->escape($gtitle);
        $tid = $this->db->escape($tid);
        $gsort = $this->db->escape($gsort);
        $gimg = $this->db->escape($gimg);
        $gcontent = $this->db->escape($gcontent);
        $status = $this->db->escape($status);
        $sql = "UPDATE `goods` SET status=$status,gname=$gname,gtitle=$gtitle,tid=$tid,gsort=$gsort,gimg=$gimg,gcontent=$gcontent WHERE gid = $gid";
        return $this->db->query($sql);
    }
}