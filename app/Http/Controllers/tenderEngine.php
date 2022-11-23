<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\apply;
use App\Models\datasets;
use Illuminate\Support\Facades\DB;

class tenderEngine extends Controller
{
    public function trainPredictor(Request $req){

        //load the data from database usings respective models:
        datasets::where('id', '>', 1)->delete();
        //use apply model to fetch dataset
        $data_set =  apply::all();

        //looping each data to a set
       foreach ($data_set as $data ) {
                    //# get the user_id
                $client =  $data->user_id;
                $type = $data->tender_id;
                /// #sum user total
                $sm = apply::where('user_id', $client)->sum(DB::raw('finance + cost'));
                // #update the set using the set model
                datasets::create(['user_id'=>$client, 'total'=>$sm, 'tender_id'=>$type]);
        }

        //check if the predictor was trained successfully
        return back()->with('success', 'You have Trained Predictor Successfully');
      }

    public function declareWinner(){

    }
}
