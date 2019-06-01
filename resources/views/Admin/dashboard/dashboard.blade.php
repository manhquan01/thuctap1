@extends('Admin.index')
@section('title', '  Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="ti-image"></i>
            </div>
            <div class="text-right">
                <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Total Post</p>
                <h2 class="m-b-10"><span data-plugin="counterup">{{$total_post}}</span></h2>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="ti-agenda"></i>
            </div>
            <div class="text-right">
                <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Pages</p>
                <h2 class="m-b-10"><span data-plugin="counterup">{{$total_posted}}</span></h2>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="ti-comment-alt"></i>
            </div>
            <div class="text-right">
                <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Comments</p>
                <h2 class="m-b-10"><span data-plugin="counterup">{{$total_comment}}</span></h2>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-box widget-box-three">
            <div class="bg-icon pull-left">
                <i class="ti-user"></i>
            </div>
            <div class="text-right">
                <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Users</p>
                <h2 class="m-b-10"><span data-plugin="counterup">{{$countUser}}</span></h2>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
@endsection

@section('style')

@endsection