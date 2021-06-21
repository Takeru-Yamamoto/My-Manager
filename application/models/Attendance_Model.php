<?PHP
defined('BASEPATH') or exit('No direct script access allowed');

class attendance_model extends CI_Model
{

    function __construct()
    {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();
        //$this->load->database();
        $this->load->database();
    }

    function index()
    {
        $sql = "select * from attendance where DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m') ORDER BY date asc;";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    function page_sort($posts)
    {
        $posts["page_sort"] = $posts["page_sort"]."-01";
        $sql = "select * from attendance where DATE_FORMAT(date, '%Y%m') = DATE_FORMAT('".$posts['page_sort']."', '%Y%m') ORDER BY date asc;";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    function create($data)
    {
        $res = $this->db->insert('attendance', $data);
        return $res;
    }

    function edit_input($id)
    {
        $sql = "select * from attendance where id=" . $id . ";";
        $res = $this->db->query($sql)->row_array();
        return $res;
    }

    function edit($posts)
    {
        $sql = "update attendance set start_w = '" . $posts["start_w"] . "' , end_w = '" . $posts["end_w"] . "' , start_b = '" . $posts["start_b"] . "' , end_b = '" . $posts["end_b"] . "' where id = " . $posts["id"] . " and date = '" . $posts["date"] . "';";
        $res = $this->db->query($sql);
        return $res;
    }

    function delete($id, $date)
    {
        $sql = "delete from attendance where id = " . $id . " and date = '" . $date . "';";
        $res = $this->db->query($sql);
        return $res;
    }

    function comparison_date()
    {
        $sql = "select date from attendance;";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    function work_start()
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $sql  = "select date from attendance where date = '" . $date . "';";
        $result = $this->db->query($sql)->row_array();
        if (isset($result) && $result['date'] == $date) {
            $res = false;
            return $res;
        } else {
            $sql = "insert into attendance(date,start_w) values('" . $date . "','" . $time . "');";
            $res = $this->db->query($sql);
            return $res;
        }
    }

    function work_end()
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $sql  = "select * from attendance where date = '" . $date . "';";
        $result = $this->db->query($sql)->row_array();
        if (!isset($result) || $result["start_b"] <> '00:00:00' && $result["end_b"] == "00:00:00") {
            $res = false;
            return $res;
        } else {
            $sql = "update attendance set end_w = '" . $time . "' where date = '" . $date . "';";
            $res = $this->db->query($sql);
            return $res;
        }
    }

    function break_start()
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $sql  = "select * from attendance where date = '" . $date . "';";
        $result = $this->db->query($sql)->row_array();
        if (!isset($result) || $result["end_b"] <> "00:00:00" || $result["end_w"] <> "00:00:00") {
            $res = false;
            return $res;
        } else {
            $sql = "update attendance set start_b = '" . $time . "' where date = '" . $date . "';";
            $res = $this->db->query($sql);
            return $res;
        }
    }

    function break_end()
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $sql  = "select * from attendance where date = '" . $date . "';";
        $result = $this->db->query($sql)->row_array();
        if (!isset($result) || $result["start_b"] == "00:00:00" || $result["end_w"] <> "00:00:00") {
            $res = false;
            return $res;
        } else {
            $sql = "update attendance set end_b = '" . $time . "' where date = '" . $date . "';";
            $res = $this->db->query($sql);
            return $res;
        }
    }

    function payroll()
    {
        $sum_wts = 0;
        $sum_bts = 0;
        $standard_sum_wts = 0;
        $standard_sum_bts = 0;
        $molded_sum_wts = 0;
        $standard_start_w = "10:00:00";
        $standard_end_w = "19:00:00";
        $standard_start_b = "14:00:00";
        $standard_end_b = "15:00:00";
        $sql = "select * from attendance WHERE DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m') ORDER BY date asc;";
        $res1 = $this->db->query($sql)->result_array();
        $sql2 = "select payroll from payroll where id = 1;";
        $res2 = $this->db->query($sql2)->row_array();
        if(!isset($res2)){
            $res2=array(
                "payroll"=>0
            );
            $sql3="INSERT INTO `payroll`(`id`, `payroll`) VALUES (1,0);;";
            $res3=$this->db->query($sql3);
        }
        foreach ($res1 as $row) {
            $start_w = $row["start_w"];
            $end_w = $row["end_w"];
            $start_b = $row["start_b"];
            $end_b = $row["end_b"];
            if ($end_w <> "00:00:00" && $end_b <> "00:00:00") {
                $worktime_second = $this->time_calculation1($start_w, $end_w);
                $breaktime_second = $this->time_calculation1($start_b, $end_b);
                $sum_wts += $worktime_second;
                $sum_bts += $breaktime_second;
                $standard_worktime_second = $this->time_calculation1($standard_start_w, $standard_end_w);
                $standard_breaktime_second = $this->time_calculation1($standard_start_b, $standard_end_b);
                $standard_sum_wts += $standard_worktime_second;
                $standard_sum_bts += $standard_breaktime_second;
                $molded_worktime_second = $this->time_calculation1($start_w, $standard_end_w);
                $molded_sum_wts += $molded_worktime_second;
            }
        }
        $rwt_stamp = $sum_wts - $sum_bts;
        $rwt_sec = $rwt_stamp % 60;
        $rwt_min_ts = ($rwt_stamp - $rwt_sec) / 60;
        $rwt_min = $rwt_min_ts % 60;
        $rwt_hour = ($rwt_min_ts - $rwt_min) / 60;
        $rpr = ($rwt_hour * $res2["payroll"]) + ($rwt_min * ($res2["payroll"] / 60)) + ($rwt_sec * ($res2["payroll"] / 3600));

        $mwt_stamp = $molded_sum_wts - $standard_sum_bts;
        $mwt_sec = $mwt_stamp % 60;
        $mwt_min_ts = ($mwt_stamp - $mwt_sec) / 60;
        $mwt_min = $mwt_min_ts % 60;
        $mwt_hour = ($mwt_min_ts - $mwt_min) / 60;
        $mpr = ($mwt_hour * $res2["payroll"]) + ($mwt_min * ($res2["payroll"] / 60)) + ($mwt_sec * ($res2["payroll"] / 3600));

        $swt_stamp = $standard_sum_wts - $standard_sum_bts;
        $swt_sec = $swt_stamp % 60;
        $swt_min_ts = ($swt_stamp - $swt_sec) / 60;
        $swt_min = $swt_min_ts % 60;
        $swt_hour = ($swt_min_ts - $swt_min) / 60;
        $spr = ($swt_hour * $res2["payroll"]) + ($swt_min * ($res2["payroll"] / 60)) + ($swt_sec * ($res2["payroll"] / 3600));
        $res = array(
            "payroll" => $res2["payroll"],
            "rpr" => $rpr,
            "mpr" => $mpr,
            "spr" => $spr
        );
        return $res;
    }

    function payroll_update($posts)
    {
        $sql = "update payroll set payroll = " . $posts["payroll"] . ";";
        $res = $this->db->query($sql);
        return $res;
    }

    function time_calculation1($t1, $t2)
    {

        //タイムスタンプ
        $timeStamp1 = strtotime($t1);
        $timeStamp2 = strtotime($t2);

        //タイムスタンプの差を計算
        $worktime_seconds = $timeStamp2 - $timeStamp1;

        //結果を返す
        return $worktime_seconds;
    }
}
