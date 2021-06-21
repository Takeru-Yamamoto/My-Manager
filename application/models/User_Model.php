<?PHP
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{

    function __construct()
    {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();
        //$this->load->database();
        $this->load->database();
    }

    function inputdb($array)
    {
        $sql = "insert into user(firstname,familyname,sex,address,telephonenumber,emailaddress) values(
                " . $array["firstname"] . ",
                " . $array["familyname"] . ",
                " . $array["sex"] . ",
                " . $array["address"] . ",
                " . $array["telephonenumber"] . ",
                " . $array["emailaddress"] . ")";
        $res = $this->db->query($sql);
        return $res;
    }
}
