<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AfricasTalking\SDK\AfricasTalking;

use Illuminate\Support\Facades\Auth;

use App\Models\apply;

use App\Models\tender;
use Illuminate\Support\Facades\DB;

class backend extends Controller
{

    public function settings(Request $req) {
        //dd($req);

        $key = 'FILES_SIZE';
        $value = $req->file_size;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/.env';
       
        if (file_exists($path)) {
          if (getenv($key)) {
            //replace variable if key exit
            file_put_contents($path, str_replace(
              "$key=" . getenv($key), "$key=" . $value, file_get_contents($path)
            ));
          } else {
            //set if variable key not exit
            $file   = file($path);
            $file[] = "$key=" . $value;
            file_put_contents($path, $file);
          }
        }

        return back()->with('success', 'file eligibility set');
       }

    public function femaleReport(){
                    // send notification
                    $username = 'Oleum'; // use 'sandbox' for development in the test environment
                    $apiKey   = '9dcb028bdde9dbf6d380c2042a7c2895ace98a78ef11cbcc201575ea78e083c6'; // use your sandbox app API key for development in the test environment
                    $AT       = new AfricasTalking($username, $apiKey);
                    $phone = Auth::user()->phone;
                    $name = Auth::user()->name;

                    $females = DB::table('users')->where('gender', 'female')->get();
                    $males = DB::table('users')->where('gender', 'male')->get();
                    $males_count = $males->count();
                    $number = $females->count();

                    $ratio = $number / $males_count;

                    
                     
                    // Get one of the services
                    $sms      = $AT->sms();

                   
        
                    // Use the service
                    $result   = $sms->send([
                        'to'      =>  $phone,
                        'message' => "Female Report To Admin, we have $number females who made tender application. Their ratio to men is $ratio!"
                    ]);


                    return back()->with('success', 'Report Was Sent To Your SMS Successfully');
        
    }





    public  function postTender(){
       return view('admin.addtender');
    }

    public function addTender(Request $req){


        $wk = tender::create([
            'tender_name' => $req->tender_name,
            'amount' => $req->amount,
            'tender_des' => $req->tender_des,
            'end_date' => $req->end_date,

        ]);

        if($wk){
            return back()->with('success', 'Tender Added Successfully');
        }


    }




    public function handletender(Request $req){
        //valide the imge uploaded:
       $size =  $req->licence->getSize();

       if($size > 4000000){
        return back()->with('error', 'File Cannot be more than 4mbs');
       }

    //    dd($req);

     $req->validate([
        'business_name' => ['required', 'string', 'max:255'],
        'tender_type' => ['required'],
        'finance' => ['required', ],
        'cost' => ['required', ],
        'registration_no' => ['required'],
        'date_registered' => ['required'],
        'business_address' =>['required', 'string'],
        'portfolio' => ['required', 'min:0']
     ]);

     $tender_name = $req->tender_type;



        //consume the request
        $k = apply::create([
            'tender_id'=>$tender_name,
            'business_name' =>$req->business_name,
            'finance' =>$req->finance,
            'cost' => $req->cost,
            'licence' => $size,
            'user_id' => Auth::user()->id,
            'registration_no' => $req->registration_no,
            'date_registered' => $req->date_registered,
            'business_address' => $req->business_address,
            'portfolio' => $req->portfolio,


        ]);

        if($k){


            // send notification
            $username = 'Oleum'; // use 'sandbox' for development in the test environment
            $apiKey   = '9dcb028bdde9dbf6d380c2042a7c2895ace98a78ef11cbcc201575ea78e083c6'; // use your sandbox app API key for development in the test environment
            $AT       = new AfricasTalking($username, $apiKey);
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;

            // Get one of the services
            $sms      = $AT->sms();

            // Use the service
            $result   = $sms->send([
                'to'      =>  $phone,
                'message' => "Hello $name we have received your tender application. You have successfully applied for the tender. Be patient as we process your request!"
            ]);

            return back()->with('success', 'You have applied the tender successfully');
                    }
        return back()->with('error', 'Error Encountered Try Again later or Contact admin');




    }
}
