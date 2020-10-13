<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsteroidNeoController extends Controller
{
    public function index()
    {
          return view('welcome'); 
        
    }
    public function getlineChart()
    {
        return view('neoLineChart');
    }
   
    public function getDateToshow(Request $request)
    {
       
        $this->start_date = $request->start_date;
        $this->end_date = $request->end_date;
        $url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=$this->start_date&end_date=$this->end_date&api_key=o7UWQjFxl2hpYs6sNeqw9sntykh2Swt5JGPvnfiu";
        return $this->asteroidAPI($url);
    }



    




    public function asteroidAPI($url)
    {
        
        $header =array('Content-Type: application/json','Content-Length: 0');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);      
        $response = curl_exec($ch);
        //$curl_error = curl_error($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        

        //echo '<pre>';
        //print_r($ && pre>';
        //print_r( == 400data);
        //exit;


        if( !empty($data['code']) && $data['code'] == 400 ){
            echo '<h2>'.$data['error_message'].'</h2>';
            exit;
        }
        

        $data_arr = $data;
       $astCountPerDay = array();

        if(!empty($data_arr)){
            foreach($data_arr['near_earth_objects'] as $dt=>$record){

                //to get count per day
                $astCountPerDay[$dt] = count($record);
                $astDateWise[] = $dt;
                $astDateWiseCount[] = count($record);
                //2nd point done

            //****Fastest Asteroid in km/h (Respective Asteroid ID & its speed)****
                foreach($record as $ky=>$val){
                    // speed done
                    $astid = $val['id'];
                    $fastAst[$dt][$astid] = $val['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
                    // speed done

                    // distance ast
                    $closeAst[$dt][$astid] = $val['close_approach_data'][0]['miss_distance']['kilometers'];
                    // distance done

                    // average min size
                    $averageSizeMin[$astid] = $val['estimated_diameter']['kilometers']['estimated_diameter_min'];
                    $averageSizeMax[$astid] = $val['estimated_diameter']['kilometers']['estimated_diameter_max'];
                    // average done
                    

                }

            }
            // dd($averageSizeMax);
            // echo '<pre>';
            //   print_r($closeAst);

            foreach($fastAst as $dt=>$val)
            {
            $val_max = max($val);
            $max_key = array_search($val_max, $val);
            // $dtwise_max[$dt][$max_key]= $val_max;
            $dtwise_max[$max_key]= $val_max;
            }
            $final_max = max($dtwise_max);
            $final_max_key = array_search($final_max, $dtwise_max);
            $fastest_ast_id = $final_max_key;
            $fastest_ast_speed = $final_max;

            //***********************end fastest************

            //***** Closest Asteroid (Respective Asteroid ID & its distance)*****
            foreach($closeAst as $dt=>$val)
            {
            $val_min = min($val);
            $min_key = array_search($val_min, $val);
            // $dtwise_max[$dt][$max_key]= $val_max;
            $dtwise_min[$min_key]= $val_min;
            }
            // print_r($dtwise_min);
            $closest_min = min($dtwise_min);
            $closest_min_key = array_search($closest_min, $dtwise_min);
            $closest_ast_id = $closest_min_key;
            $closest_ast_distance = $closest_min;
            //******** */ end closest***********

            // ********************Average*****************
            $averageAstMin = array_sum($averageSizeMin)/count($averageSizeMin);
            $averageAstMax = array_sum($averageSizeMax)/count($averageSizeMax);
            //***********************end average************


                // dd($final);
            //echo '<pre>';
            //print_r($astDateWise);
            //print_r($astDateWiseCount);

            $dataArray['astCountPerDay'] = $astCountPerDay;
            $astDateWiseJson = json_encode($astDateWise);
            $astDateWiseCountJson = json_encode($astDateWiseCount);

            //echo '<pre>';
            //print_r($astDateWiseJson);
            //print_r($astDateWiseCountJson);

            return view('neoLineChart',compact('dataArray','astDateWiseJson','astDateWiseCountJson','fastest_ast_id','fastest_ast_speed','closest_ast_id','closest_ast_distance','averageAstMin','averageAstMax'));


        }






    
    
    }   
    
    
    
}
