@extends('layouts.main')

@section('content')
@if (\Session::has('success'))
   @php
       $body =\Session::get('success');
   @endphp
           
    <script>
        swal('Good job!',  "{{ $body }}", 'success');
    </script>
    
@endif

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Tender To Your System</h6>
                            <form method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="tender_name" class="form-label">Tender Name</label>
                                    <input type="text" class="form-control" name="tender_name" id=""
                                        aria-describedby="">
                                    <div id="" class="form-text">The Name Of The Tender.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tender_name" class="form-label">Tender Description</label>
                                    <input type="text" class="form-control" name="tender_des" id=""
                                        aria-describedby="">
                                    <div id="" class="form-text">Tender Quick Note.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tender_name" class="form-label">Tender Amount</label>
                                    <input type="number" class="form-control" name="amount" id=""
                                        aria-describedby="">
                                    <div id="" class="form-text">Amount Of supplies.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Date" class="form-label">Choose Dateline</label>
                                    
                                    <input type="date" 
                                                    class="form-control"
                                                    id="end_date" 
                                                    name="end_date"
                                                    min="{{ date('Y-m-d') }}" 
                                                    max="2032-09-30"
                                                    defaultValue="2032-09-30">

                                </div>

                                <button type="submit" class="btn btn-primary">Add Tender</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection