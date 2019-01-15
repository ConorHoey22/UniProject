@extends('layouts.userLayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Dashboard') }}</div>
                    <br>

                    <div class="card-body">
                       
                        <div class="recommendations">
                            <p>Recommendations</p>
                        </div>

                    </div>

                        <div class="Navigation-Search">
                            <button>Search</button>
                        </div>

                    </div>
                </div>
           </div>
       </div>
    </div>
</div>

@endsection
