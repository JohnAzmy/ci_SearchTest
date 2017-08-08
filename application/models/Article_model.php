<?php
class Article_model extends CI_Model {

        public $id;
        public $titlear;
        public $descar;
        public $aimage;
        public $adate;
        public $atags;
        public $abrief;
        public $arr_results;
        public $imagepath_large;
        public $imagepath_small;

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }
        
        public function geAll($limit)
        {
            if($limit>0)
                $rsAllCat = $this->db->query("SELECT * FROM tblarticles WHERE aorder<>0 ORDER BY id DESC LIMIT $limit");
            else
                $rsAllCat = $this->db->query("SELECT * FROM tblarticles WHERE aorder<>0 ORDER BY id DESC");
        
            if ($rsAllCat)
            {
                $this->arr_results  = $rsAllCat;
            }
        }
        
        public function getArticle($varID)
        {
            if($varID>0)
                  $strSQL = 'SELECT * FROM tblarticles WHERE id='. $varID;
            else
                  $strSQL = "SELECT * FROM tblarticles ORDER BY id DESC LIMIT 1;";

            $rsAllCat = $this->db->query($strSQL);
              
            
            foreach ($rsAllCat->result_array() as $row)
            {
                $this->id  = $row['id'];
                $this->titlear = $row['atitle'];
                $this->descar = $row['abody'];
                $this->adate = $row["adate"];
                $this->atags = $row["atags"];
                $this->aimage = $row["aimage"];
                $this->abrief = $row["abrief"];
                $this->arr_results = $row;
            }
        }
        
        public function getSearch($strTitle, $limit)
        {
            $strSQL = "SELECT id, atitle as name, atitle as tagtitle, 0 FROM tblarticles WHERE (atitle like '%$strTitle%') limit $limit";
            $rsAllCat = $this->db->query($strSQL);

            if ($rsAllCat){
                $this->arr_results  = $rsAllCat;
            }

        }
}
