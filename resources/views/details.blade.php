@extends('layouts.app')

@section('content')

<div class="container justify-content-center d-flex flex-wrap py-4">
    <div class="card p-0 shadow-sm m-2">
        <div class="row">
            <div class="col-sm-7">
                <img src="{{asset('storage/'.$product->image)}}" alt="Card image cap" class="card-img-top">
            </div>
            <div class="col-sm">
                <div class="card-body h-100">
                    <h4 class="card-title mt-5"><b> Price: ${{$product->price}} </b></h4>
                    <div class="mt-2"><b>Seller Information</b></div>
                    <div class="row m-0">
                        <img src="{{asset('storage/user.jpg')}}" width="50px" height="50px" class="rounded-circle mr-2"/>
                        <div>
                            <h4 class="m-0">{{$product->seller->name}}</h4>
                            <div>{{$product->seller->address}}</div>

                        </div>
                    </div>
                    <div class="my-4">
                    @guest
                        <div class="mt-2"><b>Contact details <a href="/login">[Login to view]</a> </b></div>
                        <div class="m-0 p-0">Phone: xxxxxxxxxx </div>
                        <div class="m-0 p-0">Email: xxxxxxxxxx@xxxxx.xxx</div>
                    @else
                       <div class="mt-2"><b>Contact details</b></div>
                        <div class="m-0 p-0">Phone: {{$product->seller->mobile}} </div>
                        <div class="m-0 p-0">Email: {{$product->seller->email}}</div> 
                    @endguest
                    </div>

                    <div class="mb-4">
                        <b>Safety Tips for Buyers</b><br>
                        Meet seller at a safe location<br>
                        Check the item before you buy<br>
                        Pay only after collecting items<br>
                    </div>

                    <!-- Display the Edit this Ad button only if the user_id and seller_id is matched -->
                    @if(Auth::user()->id == $product->seller->id)
                        <a href="/edit/{{$product->id}}" class="btn btn-primary">Edit this Ad</a>
                    @endif

                </div>
            </div>

        </div>
    </div>
    <div class="card m-2 w-100 bg-white shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><b>{{$product->title}}</b></h5>
            {{$product->description}}
        </div>
    </div>
</div>

@endsection