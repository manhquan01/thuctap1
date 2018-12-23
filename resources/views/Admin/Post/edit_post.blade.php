@extends('Admin.index')
@section('title', 'Edit Post')
@section('content')
    <div class="col-md-10 col-md-offset-1">
        <div class="p-20">
            <div class="">
                <form method="post" action="{{asset(route('update_post', ['id' => $post->id]))}}">
                    <div class="form-group m-b-20">
                        <label for="exampleInputEmail1">Post Title</label>
                        <input type="text" name="title" value="{{$post->title}}" class="form-control" id="exampleInputEmail1" placeholder="Enter title" required="">
                    </div>

                    <div class="form-group m-b-20">
                        <label for="exampleInputEmail1">Static Link</label>
                        <input type="text" name="static_link" value="{{$post->slug}}" class="form-control" id="exampleInputEmail1" placeholder="Static Link">
                    </div>

                    <div class="form-group m-b-20">
                        <label>Post Category</label>
                        <select class="select2 form-control" required="" name="category">
                            <option>-- Select a category for your post --</option>
                            @foreach($all_cate as $item)
                                <option value="{{$item['id']}}" @if($item['id'] == $post->category_id)selected @endif >{{$item['cate_name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group m-b-20">
                        <label>Description</label>
                        <div>
                            <textarea class="ckeditor" name="descript" required="">{{$post->content}} </textarea>
                        </div>
                    </div>

                    <div class="form-group m-b-20">
                        <label>File Uploads</label>
                        <input value="{{$post->thumbnail}}" hidden="" id="thumbnail" name="thumbnail" type="text" >
                        <button type="button" id="ckfinder-modal-1" class="button-a button-a-background">Choose thumbnail</button>
                        <button type="button" id="clear_image">clear</button>
                        <img src="{{$post->thumbnail}}" id="ckfinder-input-1" width="300px">
                    </div>
                    <input name="status" type="text" hidden value="" id="input_status">
                    <button type="submit" id="save_post" class="btn btn-info waves-effect waves-light">Save and Post</button>
                    <button type="submit" id="save_draft" class="btn btn-danger waves-effect waves-light">Save as draft</button>
                    {{csrf_field()}}
                </form>
            </div>
        </div> <!-- end p-20 -->
    </div> <!-- end col -->

@endsection

@section('script')
    <script type="text/javascript">


    </script>
    <script>

        CKEDITOR.replace( 'descript', {
            filebrowserImageBrowseUrl: '/plugins/ckfinder/ckfinder.html',
            filebrowserImageUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });

        var button1 = document.getElementById( 'ckfinder-modal-1' );

        button1.onclick = function() {
            selectFileWithCKFinder( 'ckfinder-input-1' );
        };

        function selectFileWithCKFinder( elementId ) {
            CKFinder.modal( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        var output = document.getElementById( elementId );
                        output.setAttribute('src' ,file.getUrl());
                        document.getElementById('thumbnail').value = file.getUrl();
                        $('#clear_image').attr('hidden', false);
                        $('#ckfinder-modal-1').attr('hidden', true);
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.setAttribute('src' ,evt.data.resizedUrl);
                        document.getElementById('thumbnail').value = evt.data.resizedUrl;
                        $('#clear_image').attr('hidden', false);
                        $('#ckfinder-modal-1').attr('hidden', true);
                    } );
                }
            } );
        }

        $('#clear_image').click(function(){
            $('#ckfinder-input-1').attr('src', '');
            $('#thumbnail').val('');
            $('#clear_image').attr('hidden', true);
            $('#ckfinder-modal-1').attr('hidden', false);
        });

        if ($('#thumbnail').val() != '')
        {
            $('#clear_image').attr('hidden', false);
            $('#ckfinder-modal-1').attr('hidden', true);
        } else
        {
            $('#ckfinder-modal-1').attr('hidden', false);
            $('#clear_image').attr('hidden', true);
        }

        // set status = posted
        $('#save_post').click(function () {
            $('#input_status').val(0);
        });

        // set status = draft
        $('#save_draft').click(function () {
            $('#input_status').val(2);
        });

    </script>

@endsection

@section('style')

@endsection
