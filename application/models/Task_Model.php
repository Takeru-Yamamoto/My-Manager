<?PHP
defined('BASEPATH') or exit('No direct script access allowed');

class task_model extends CI_Model
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
        $ymd=date("Y-m-d");
        $swd = date("w",strtotime($ymd));
        $tw_s=date('Y-m-d', strtotime("-{$swd} day", strtotime($ymd)));
        $lwd=6-$swd;
        $tw_e=date('Y-m-d', strtotime("+{$lwd} day", strtotime($ymd)));
        $sql = "SELECT * FROM task WHERE genre = 'day' AND date = '".$ymd."' ORDER BY date asc;";
        $res = $this->db->query($sql)->result_array();
        if($res == null){
            $res = array(array("task_c"=>"There Are No Task For Today."));
        }
        $sql2 = "SELECT * FROM task WHERE genre = 'week' AND date between '".$tw_s."' and '".$tw_e."'  ORDER BY date asc;";
        $res2 = $this->db->query($sql2)->result_array();
        if($res2 == null){
            $res2 = array(array("task_c"=>"There Are No Task For This Week."));
        }
        $sql3 = "SELECT * FROM task WHERE genre = 'month' AND DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m') ORDER BY date asc;";
        $res3 = $this->db->query($sql3)->result_array();
        if($res3 == null){
            $res3 = array(array("task_c"=>"There Are No Task For This Month."));
        }
        return [$res, $res2, $res3];
    }

    function edit_and_delete(){
        $sql = "SELECT * FROM task WHERE genre = 'day' AND  DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m') ORDER BY date asc;";
        $res = $this->db->query($sql)->result_array();
        $sql2 = "SELECT * FROM task WHERE genre = 'week' ORDER BY date asc;";
        $res2 = $this->db->query($sql2)->result_array();
        $sql3 = "SELECT * FROM task WHERE genre = 'month' ORDER BY date asc;";
        $res3 = $this->db->query($sql3)->result_array();
        return [$res,$res2,$res3];
    }

    function create($data)
    {
        $res = $this->db->insert('task', $data);
        return $res;
    }

    function comparison_date()
    {
        $sql = "select date,genre from task;";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    function edit_input($id){
        $sql = "select * from task where id=".$id.";";
        $res = $this->db->query($sql)->row_array();
        return $res;
    }

    function edit($posts){
        $sql = "update task set task_c = '".$posts["task_c"]."', genre = '".$posts["genre"]."' where id = ".$posts["id"]." and date = '".$posts["date"]."';";
        $res = $this->db->query($sql);
        return $res;
    }

    function delete($id,$date){
        $sql="delete from task where id = ".$id." and date = '".$date."';";
        $res = $this->db->query($sql);
        return $res;
    }
}
