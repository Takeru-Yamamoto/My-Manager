<?PHP
defined('BASEPATH') or exit('No direct script access allowed');

class deliverytime_model extends CI_Model
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
        $sql = "SELECT min(date),id,content FROM deliverytime GROUP BY date;";
        $res = $this->db->query($sql)->result_array();
        if($res == null){
            $res = array(array("min(date)"=>"There Are No deliverytime.","content"=>"Don't eat anything that doesn't work."));
        }
        $sql2 = "SELECT * FROM deliverytime WHERE date between '".$tw_s."' and '".$tw_e."'  ORDER BY date asc;";
        $res2 = $this->db->query($sql2)->result_array();
        if($res2 == null){
            $res2 = array(array("date"=>"There Are No deliverytime.","content"=>"Work briskly fucking bitch."));
        }
        $sql3 = "SELECT * FROM deliverytime WHERE DATE_FORMAT(date, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m') ORDER BY date asc;";
        $res3 = $this->db->query($sql3)->result_array();
        if($res3 == null){
            $res3 = array(array("date"=>"There Are No deliverytime.","content"=>"Look around. You're the only one who doesn't have a job."));
        }
        return [$res, $res2, $res3];
    }

    function edit_and_delete(){
        $sql = "SELECT * FROM deliverytime ORDER BY date asc;";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    function create($data)
    {
        $res = $this->db->insert('deliverytime', $data);
        return $res;
    }

    function comparison_date()
    {
        $sql = "select date from deliverytime;";
        $res = $this->db->query($sql)->result_array();
        return $res;
    }

    function edit_input($id){
        $sql = "select * from deliverytime where id=".$id.";";
        $res = $this->db->query($sql)->row_array();
        return $res;
    }

    function edit($posts){
        $sql = "update deliverytime set content = '".$posts["content"]."' where id = ".$posts["id"]." and date = '".$posts["date"]."';";
        $res = $this->db->query($sql);
        return $res;
    }

    function delete($id,$date){
        $sql="delete from deliverytime where id = ".$id." and date = '".$date."';";
        $res = $this->db->query($sql);
        return $res;
    }
}
