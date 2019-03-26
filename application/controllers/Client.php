<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Type_spot_model');
        $this->load->model('Spot_model');
        $this->load->model('Review_model');
        $this->load->model('Gallery_model');
        $this->load->model('Product_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $returnArray = array();
        $spotList = array();
        
        $type_spot = $this->Type_spot_model->get_all();
        $spot = $this->Spot_model->get_all();

        foreach ($spot as $keySpot) {
            $tmpType = $this->Type_spot_model->get_by_id($keySpot->type_spot_id);
            $tmpImage = $this->Gallery_model->get_by_spot($keySpot->id);
            $tmpArray = array(
                'id' => $keySpot->id,
                'name' => $keySpot->name, 
                'image' => $tmpImage[0]->image, 
                'description' => $keySpot->description, 
                'latitude' => $keySpot->latitude, 
                'longitude' => $keySpot->longitude, 
                'type' => $tmpType->name, 
            );
            // var_dump($tmpImage);
            array_push($spotList,$tmpArray);
        }
        foreach ($type_spot as $keyType) {
            $tmp = $this->getTopSpotByReview($keyType->id);
            $tmpArray = array(
                'id' => $keyType->id,
                'name' => $keyType->name,
                'title' => $keyType->title,
                'description' => $keyType->description,
                'image' => $keyType->image,
                'listSpot' => $tmp,
            );
            array_push($returnArray,$tmpArray);
        }

        $data = array(
            'type_spot' => $returnArray,
            'listMaps' => json_encode($spotList),
        );
        
        $this->render['content']= $this->load->view('client_page/home', $data, TRUE);
        $this->load->view('templateClient', $this->render);
    }
    public function detail($id){
        $ses = $this->session->userdata('logged_in');
        $tmpSpot = $this->Spot_model->get_by_id($id);
        $review = $this->Review_model->get_by_spot($tmpSpot->id);
        if(!empty($ses)){
            $dataReview = count($this->Review_model->get_by_spotUser($tmpSpot->id,$ses['id']));
            $review_user = $this->Review_model->get_by_spotUser($tmpSpot->id,$ses['id'])[$dataReview -1 ]->rating;
        }else{
            $review_user = 0;
        }
        $tmp = 0;

        foreach ($review as $key) {
            $tmp += $key->rating;
        }

        $data = array(
            'spot' => $tmpSpot,
            'image' => $this->Gallery_model->get_by_spot($tmpSpot->id),
            'type' => $this->Type_spot_model->get_by_id($tmpSpot->type_spot_id),
            'rating' => $tmp/count($review),
            'review' => $review_user,
            'review_all' =>$this->Review_model->get_by_spot($tmpSpot->id),
            'product' => $this->Product_model->get_by_spot($tmpSpot->id),
            'root_url' => base_url(),
            'action' => site_url('review/create_action')
        );
        $this->render['content']= $this->load->view('client_page/detail_location', $data, TRUE);
        $this->load->view('templateClient', $this->render);
    }
    private function getTopSpotByReview($id){
        $dataReturn = array();
        $dateSpot = $this->Spot_model->get_by_type($id);
        foreach ($dateSpot as $keySpot) {
            $totalReting = 0;
            $dataReview = $this->Review_model->get_by_spot($keySpot->id);
            $tmpImage = $this->Gallery_model->get_by_spot($keySpot->id);
            foreach ($dataReview as $keyReview) {
                $totalReting += $keyReview->rating;
            }
            
            if(count($dataReview) > 0){
                $totalReting = $totalReting / count($dataReview);
            }

            $tmp = array(
                'id' => $keySpot->id, 
                'name' => $keySpot->name, 
                'image' => $tmpImage[0]->image, 
                'description' => $keySpot->description, 
                'latitude' => $keySpot->latitude, 
                'longitude' => $keySpot->longitude,
                'reting' =>  $totalReting,
            );
            array_push($dataReturn,$tmp);
        }
        
        usort($dataReturn, function($a, $b) {return $b['reting'] <=> $a['reting'];});

        return array_slice($dataReturn,0,4);
    }
    

}

/* End of file Gallery.php */
/* Location: ./application/controllers/Gallery.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-03-22 05:40:35 */
/* http://harviacode.com */