<?php

class HomeController extends CI_Controller
{
    public function index(){
        $txtId = $this->input->post('txtId');
        $txtSearch = $this->input->post('txtSearch');
        //echo 'Here: '.$txtSearch;        
        $this->load->model("Article_model");
        $data = array();
        $rsSearchResult = array();
        if(isset($txtSearch))
        {
            $clsSearch = new Article_model();
            $clsSearch->getSearch($txtSearch,50);
            $rsSearch = $clsSearch->arr_results;
            foreach ($rsSearch->result_array() as $row){
                $clsArticle = new Article_model();
                $clsArticle->getArticle($row['id']);
                $rsArr = $clsArticle->arr_results;
                $rsSearchResult[] = $rsArr;
            }
            
            $data['data'] = array('rsSearch'=>$rsSearchResult);
        }
        
        $this->load->view("home/articles", $data);
    }
    
    public function search_ajax(){
        $txtId = $this->input->get('txtId');
        $txtType=0;
        $txtSearch = $this->input->get('q');
                
        $this->load->model("Article_model");
        
        if(strlen($txtSearch)>2)
        {
            $clsSearch = new Article_model();
            $clsSearch->getSearch($txtSearch,50);
            $rsSearch = $clsSearch->arr_results;
            
            if(count($rsSearch)>0){
                foreach($rsSearch->result_array() as $row){
                    $arrSearch[] = $row;
                }
            }
        }
        
        $arrSearch[] = array("id"=>'0', "name"=>$txtSearch, "tagtitle"=>'search for '.$txtSearch,"newstype"=>'0');   //first item in the results autocomplete array
        
        echo json_encode($arrSearch);
    }
}