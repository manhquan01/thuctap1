@extends('Frontend.index')
@section('title', 'TV show')
@section('content')

    <div class="row blog-post-column" style="padding-bottom: 20px">
        @foreach($data as $item)
            <div class="col-md-12 m-t-20">
                <!-- Image Post -->
                <div class="col-md-5">
                    <img src="{{$item->thumbnail}}" alt="" class="img-responsive" style=" display:block; width: 300px; height: 200px; object-fit: cover">
                </div>
                <div class=" col-md-7">
                    <div class="post-title">
                        <h3><a href="{{asset(route('frontend_article', ['slug' => $item['slug']]))}}">{{$item->title}}</a></h3>
                    </div>
                    <div class="text-muted"><i class="mdi mdi-clock"></i> <span>{{$item->updated_at}}</span></div>
                    <div>
                        <p>@php echo $item['descript'] @endphp
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$data->links()}}

@endsection