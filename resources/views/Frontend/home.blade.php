@extends('Frontend.index')
@section('title', 'Home')
@section('content')

    <!-- Slider Post -->
    <div class="blog-post m-b-30">
        <div class="post-image">
            <div id="blog-slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators m-b-30">
                    <li data-target="#blog-slider" data-slide-to="0"
                        class="active"></li>
                    <li data-target="#blog-slider" data-slide-to="1"></li>
                    <li data-target="#blog-slider" data-slide-to="2"></li>
                    <li data-target="#blog-slider" data-slide-to="3"></li>
                    <li data-target="#blog-slider" data-slide-to="4"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($feature as $fea)
                    <div class="item">
                        <img alt="Blog-img" href="{{asset(route('frontend_article', ['slug' => $fea['slug']]))}}" src="{{$fea['thumbnail']}}" class="img-responsive" style="width: 1100px; height: 402px; object-fit: cover"/>
                        <div class="post-title">
                            <a href="{{asset(route('frontend_article', ['slug' => $fea['slug']]))}}"><h3 href="/Internet">{{$fea['title']}}</h3></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @foreach($category as $item)

    <div class="m-t-50">
        <h4 class="text-uppercase">{{$item->cate_name}}</h4>
        <div class="border m-b-20"></div>

        @foreach($posts as $value)
            @foreach($value as $val)
            @if($val['category_id'] == $item->id)
        <div class="row blog-post-column" style="padding-bottom: 20px">
            <div class="col-md-12 m-t-20">
                <!-- Image Post -->
                <div class="col-md-5">
                    <img src="{{$val['thumbnail']}}" alt="" class="img-responsive" style=" display:block; width: 300px; height: 200px; object-fit: cover">
                </div>
                <div class=" col-md-7">
                    <div class="post-title">
                        <h3><a href="{{asset(route('frontend_article', ['slug' => $val['slug']]))}}">{{$val['title']}}</a></h3>
                    </div>
                    <div class="text-muted"><i class="mdi mdi-clock"></i> <span>{{$val['updated_at']}}</span></div>
                    <div>
                        <p>@php echo $val['descript'] @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div>
            @endif
            @endforeach
        @endforeach
    </div>

    @endforeach


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.item').first().addClass('active');
        });

    </script>
@endsection