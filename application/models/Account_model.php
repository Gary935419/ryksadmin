<?php


class Account_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }

    public function getUserAllPage()
    {
        $sql = "SELECT count(1) as number FROM `users` ";
        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }

    public function getUserAll($pg)
    {
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT u.uid as uid,u.user_name as user_name,u.add_time as add_time,r.rname as rname FROM `users` u left join `role` r on u.rid=r.rid  order by u.uid desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }

    public function getUserById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `users` where uid=$id ";
        return $this->db->query($sql)->row_array();
    }

    public function userdel($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM users WHERE uid = $id;";
        return $this->db->query($sql);
    }

    public function getMenu($type)
    {
        $sql = "SELECT * FROM `menu` where fid=0 and type=$type  order by msort asc ";
        return $this->db->query($sql)->result_array();
    }

    public function getMenuByFid($fid)
    {
        $fid = $this->db->escape($fid);
        $sql = "SELECT * FROM `menu` where fid=$fid order by msort asc ";
        return $this->db->query($sql)->result_array();
    }

    public function getMenuAllPage()
    {
        $sql = "SELECT count(1) as number FROM `menu` ";
        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }

    public function getMenuAll($pg)
    {
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT m.*,n.mname fmname FROM `menu` m left join `menu` n on m.fid=n.mid  order by mid asc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }

    public function getRoleAllPage()
    {
        $sql = "SELECT count(1) as number FROM `role` ";
        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }

    public function getRole()
    {
        $sql = "SELECT * FROM `role` order by rid desc";
        return $this->db->query($sql)->result_array();
    }

    public function getRoleAll($pg)
    {
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `role` order by rid asc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }

    public function getRoleById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `role` where rid=$id ";
        return $this->db->query($sql)->row_array();
    }

    public function rolesave($id, $rname)
    {
        $rname = $this->db->escape($rname);
        if (!empty($id)) {
            $id = $this->db->escape($id);
            $sql = "UPDATE `role` SET `rname` =  $rname WHERE rid = $id";
            return $this->db->query($sql);
        } else {
            $sql = "INSERT INTO `role` (`rname`) VALUES ($rname);";
            return $this->db->query($sql);
        }
    }

    public function roledel($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM rtom WHERE rid = $id;DELETE FROM role WHERE rid = $id;";
        return $this->db->query($sql);
    }

    public function rtomsave($id, $mids)
    {
        $id = $this->db->escape($id);
        $sqlde = "DELETE FROM rtom WHERE rid = $id;";
        $this->db->query($sqlde);
        foreach ($mids as $key => $mid) {
            $midone = $this->db->escape($mid);
            if ($key + 1 < count($mids)) {
                $sql = "INSERT INTO `rtom` (`rid`, `mid`) VALUES ($id,$midone);";
                $this->db->query($sql);
            } else {
                $sql = "INSERT INTO `rtom` (`rid`, `mid`) VALUES ($id,$midone);";
                return $this->db->query($sql);
            }
        }
    }

    public function CheckRoleName($name)
    {
        $name = $this->db->escape($name);
        $sql = "SELECT count(1) as num FROM `role` where rname=$name ";
        return $this->db->query($sql)->row()->num > 0;
    }

    public function CheckIdRoleName($rname)
    {
        $rname = $this->db->escape($rname);
        $sql = "SELECT rid  FROM `role` where rname=$rname ";
        return $this->db->query($sql)->row_array();
    }

    public function CheckHaveMenu($id, $mid)
    {
        $id = $this->db->escape($id);
        $mid = $this->db->escape($mid);
        $sql = "SELECT count(1) as number FROM `menu` m left join `rtom` n on m.mid=n.mid where rid=$id and n.mid=$mid ";
        return $this->db->query($sql)->row()->number > 0;
    }

    public function CheckUserName($uname)
    {
        $uname = $this->db->escape($uname);
        $sql = "SELECT count(1) as num FROM `users` where user_name=$uname ";
        return $this->db->query($sql)->row()->num > 0;
    }

    public function getUser($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `users` where uid = $id";
        return $this->db->query($sql)->row_array();
    }

    public function getRtom($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `rtom` where rid = $id";
        return $this->db->query($sql)->result_array();
    }

    public function userpassportsave($id, $upass)
    {
        if (!empty($id)) {
            $id = $this->db->escape($id);
            $upass = md5($upass);
            $upass = $this->db->escape($upass);
            $sql = "UPDATE `users` SET `user_pass` =  $upass,`add_time` =  " . time() . " WHERE uid = $id";
            return $this->db->query($sql);
        }
    }

    public function getUserByrid($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `users` where rid = $id";
        return $this->db->query($sql)->result_array();
    }

    public function getrtomselect($murl, $rid)
    {
        $murl = $this->db->escape($murl);
        $rid = $this->db->escape($rid);
        $sql = "SELECT * FROM `rtom` where mid in (select mid from menu where murl = $murl ) and rid = $rid ";
        return $this->db->query($sql)->row_array();
    }
}