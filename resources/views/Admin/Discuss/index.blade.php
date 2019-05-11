@extends('Admin.index')
@section('title', 'Discuss')
@section('content')
    <div class="row table-responsive">
        <table class="table m-0" id="table_data">
            <thead>
            <tr>
                <th><input type="checkbox" id="check_all"></th>
                <th>Author</th>
                <th>Comment</th>
                <th>Reply for</th>
                <th>Posted at</th>
            </tr>
            </thead>

            <tbody>
            @foreach($comment as $data)
            <tr>
                <td align="center" width="35px"><input type="checkbox" value="" name="id[]" class="checkitem"></td>
                <td>{{$data->user_d->name}}</td>
                <td width="50%">{{$data->comment}}</td>
                <td>{{$data->post->title}}
                    <br>
                    <a href="{{asset(route('frontend_article', $data->post->slug))}}">See the article</a>
                </td>
                <td>{{$data->created_at}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')

@endsection