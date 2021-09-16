@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container d-flex justify-content-center flex-wrap py-4">
            
            <!-- @for($i=1; $i<=sizeof($products); $i++)
            <div class="card m-2 shadow-sm" style="width: 17rem;">

                <img src="{{asset('storage/product1.jpg')}}" alt="Card image cap" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <div>

                    </div>
                    <p class="card-text" style="height: 3rem; line-height: 1.5em; overflow: hidden;"> This is product
                        description. The product is in excellent condition. </p>
                </div>

                <div class="card-footer d-flex">
                    <div class="w-50">
                        <b>$2000</b>
                    </div>
                    <div class="w-50 text-right">
                        <a href="/details/5" class="link-primary">View details</a>
                    </div>
                </div>

            </div>
            @endfor -->

            @foreach($products as $p)
            <div class="card m-2 shadow-sm" style="width: 17rem;">

                <img src="{{asset('storage/'.$p->image)}}" alt="Card image cap" class="card-img-top" style="height: 250px;">

                <div class="card-body">
                    <h5 class="card-title">{{$p->title}}</h5>
                    <p class="card-text" style="height: 3rem; line-height: 1.5em; overflow: hidden;"> {{$p->description}} </p>
                </div>

                <div class="card-footer d-flex">
                    <div class="w-50">
                        <b>${{$p->price}}</b>
                    </div>
                    <div class="w-50 text-right">
                        <a href="/details/{{$p->id}}" class="link-primary">View details</a>
                    </div>
                </div>

            </div>
            @endforeach

            <div class="w-100 justify-content-center d-flex py-5">{{$products->links()}}</div>

        </div>
    </div>
@endsection
