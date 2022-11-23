@extends('layouts.main')

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel">SET FILES ELIGIBILITY</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="/settings">
                @csrf
                <div class="form-group ">
                  <label for="exampleInputEmail1">FILE SIZE IN KILOBITES[KB](1KB = 1024B)</label>
                  <input type="number" name="file_size" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Liceense Size">
                  
                </div>
                <br>
              
                <button type="submit" class="btn btn-primary">Set Now</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


        @if (\Session::has('success'))
        @php
        
            $body =\Session::get('success');
        @endphp

                    <script>
                        swal('Good job!',  "{{ $body }}", 'success');
                    </script>

        @endif

        <?php
            $data = DB::table('applies')->get();

            $orders = DB::table('datasets')->orderBy('id', 'DESC')->get();

            $total = DB::table('applies')->sum('cost');
            $d = DB::table('applies')->get();
            $num = $d->count();
            $rates = $total / $num;

            $total_f = DB::table('applies')->sum('finance'); //6
            $f = ($total_f / $num); //2
            $percentage = $f/3 * 100;

            $female = DB::table('users')->where('gender', 'female')->get();
            $male = DB::table('users')->where('gender', 'male')->get();




        ?>

        @if(!empty($_GET['id']))
        <?php
            $user = $_GET['id'];
            $user = DB::table('users')->where('id', $user)->first();
        ?>
                    <script>
                        swal("{{ $user->name }}",  "{{ $user->phone }}", 'success');
                    </script>
        @endif
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Application</p>
                                <h6 class="mb-0">{{ $data->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Average Capital</p>
                                <h6 class="mb-0">{{ $total/$num }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Average Cabability</p>
                                <h6 class="mb-0">{{ number_format($percentage, 2) }}%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Gender Ratio(M:W)</p>
                                <h6 class="mb-0">{{ $female->count() }}:{{ $male->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->






            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">ALL APPLICATIONS MADE</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">



                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Business Name</th>
                                    <th scope="col">Tender</th>
                                    <th scope="col">Finance Status</th>
                                    <th scope="col">Capital(cost)</th>
                                    <th scope="col">Licence</th>
                                    <th scope="col">Eligibility</th>
                                    <th scope="col">Registration No</th>
                                    <th scope="col">Date Registered</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Date Applied</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->count() >0 )
                                  @foreach ($data as $d)
                                  @php
                                      $actual = env('FILE_SIZE');
                                      $min= $actual - 2000;
                                      $max = $actual + 2000;
                                  @endphp

                                  <tr>

                                    <td>{{$d->business_name}}</td>
                                    <td>{{$d->tender_id}}</td>
                                    <td>{{$d->finance}}</td>
                                    <td>{{$d->cost}}</td>
                                    <td>{{$d->licence}}</td>
                                    <td>
                                        @if($d->licence > $max OR $d->licence < $min)
                                            <b>Not Eligible</b>
                                        @else

                                        <b>Eligible</b>

                                        @endif
                                        



                                    </td>
                                    <td>{{$d->registration_no}}</td>
                                    <td>{{$d->date_registered}}</td>
                                    <td>{{$d->business_address}}</td>
                                    <td>{{$d->portfolio}}</td>
                                    <td>{{$d->created_at}}</td>

                                </tr>

                                  @endforeach

                                @endif



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->
<?php

$tables = DB::table('tenders')->get();

?>

@if($tables->count() > 0)
@foreach ($tables as $table)
  @php
//   import sms lib
 
// fetch table data(specific data)
      $ai_order = DB::table('datasets')->where('tender_id', $table->tender_name)->orderBy('id', 'DESC')->get();
      
  @endphp  

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">

                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Ai Application Order On {{ $table->tender_name }}</h6>

                            </div>

                            <div class="d-flex align-items-center border-bottom py-3">

                                <div class="w-100 ms-3">
                                    @if($ai_order->count() > 0)
                                    @foreach ($ai_order as $order)
                                    @php
                                        $first_client = DB::table('datasets')->where('tender_id', $table->tender_name)->orderBy('id', 'DESC')->first();
                                        $user_id = $first_client->user_id;
                                        $user = DB::table('users')->where('id', $user_id)->first();
                                        $user_phone = $user->phone;
                                        $user_name = $user->name;
                                        $sms_status = DB::table('applies')->where('user_id', $user_id)->value('sms');
                                        //send sms notification to the tender winner
                                                    // send notification
                                         if($sms_status !== 'sent'){
                                            //mark it sent
                                            DB::table('applies')->where('user_id', $user_id)->update(['sms' => 'sent']);
                                                $username = 'Oleum'; // use 'sandbox' for development in the test environment
                                                $apiKey   = '9dcb028bdde9dbf6d380c2042a7c2895ace98a78ef11cbcc201575ea78e083c6';
                                                // use your sandbox app API key for development in the test environment
                                                
                                                $AT = new  AfricasTalking\SDK\AfricasTalking($username, $apiKey);
                                            

                                                // Get one of the services
                                                $sms      = $AT->sms();

                                                // Use the service
                                                $result   = $sms->send([
                                                    'to'      =>  $user_phone,
                                                    'message' => "Congratulations $user_name. You have qualified for the tender."
                                                ]);

                                         }

                                    @endphp
                                    <div class="d-flex w-100 justify-content-between">
                                        <?php

                                           $id = $order->user_id;


                                           ?>
                                        <h6 class="mb-0">User Id :{{ $id }}</h6>
                                        <small><a href="?id={{ $id }}"><button class="btn btn-success">View User</button></a></small>
                                    </div>
                                    <hr>
                                    @endforeach

                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <!-- Widgets End -->


@endforeach
@endif
           




        

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Registered Users </h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">



                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Name</th>
                                    <th scope="col">Key</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Date Regitered</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $users = DB::table('users')->get();
                                @endphp
                                @if($users->count() >0 )
                                  @foreach ($users as $d)

                                  <tr>

                                    <td>{{$d->name}}</td>
                                    <td>{{$d->id}}</td>
                                    <td>{{$d->gender}}</td>
                                    <td>{{$d->phone}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>{{$d->created_at}}</td>

                                </tr>

                                  @endforeach

                                @endif



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            @endsection
