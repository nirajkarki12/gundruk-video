@extends('layouts.admin')

@section('title', 'Video Upload')

@section('content-header', 'Video Upload')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>Video Upload</li>
@endsection

@section('content')

    <div class="row">

    @include('notification.notify')
    
    <div class="col-md-12">
        <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                    <li><a href="#video_setting" data-toggle="tab">Video Setting</a></li>
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="general">
                        <h4>General</h4>
                        <hr>
                        <form id="form-upload" action="{{route('admin.video.create')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Video Title *</label>
                                        <input type="text" class="form-control" name="title" value="" id="title" placeholder="Enter video title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group video-upload">
                                        <div class="video-upload text-center" style="border: solid 1px #ccc;">
                                            <div id="resumable-drop">
                                                <label for="video" style="cursor:pointer">
                                                    <img src="https://goo.gl/pB9rpQ"/>
                                                </label>
                                                <input type="file" id="video" data-url="{{route('admin.video.create')}}" name="video" class="form-control" style="display:none">
                                                <p class="help-block">Video File Only *</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                          </div>
                          <!-- /.box-body -->

                          
                    </div>

                    <div class="tab-pane" id="video_setting">
                            <h4>Video Settings</h4>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tag">Tags *</label>
                                    <input type="text" name="tag" data-role="tagsinput" class="form-control" id="tag" style="display:block" placeholder="comma ( , ) sepearted">
                                    <span></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publish_at">Publish Time *</label>
                                    <input type="datetime-local" name="publish_at" value="" class="form-control" id="publish_at" style="display:block" placeholder="Time to publish the video">
                                    <span></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tagname">Description *</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Description of video" style="height:150px"></textarea>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">Cover Image *</label>
                                        <input type="file" name="image" class="form-control" id="image" accept="image/png,image/jpg,image/jpeg">
                                    </div> 
                                </div>
                                <div class="col-lg-6">
                                     <div class="form-group">
                                        <label for="category_id">Category *</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                    
                          </div>
                          <!-- /.box-body -->
                    </div>

                </div>

            </div>
            <div class="progress border" style="display:none">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="target"></div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
</div>
    </div>
@endsection
@section('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script type="text/javascript">
 $('#form-upload').submit(function(e){
     e.preventDefault();
    $.ajax({
            url: '{{route("admin.video.create")}}',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.progress').show();
            },
            xhr: function() {
                // var form = $('#form-upload :input,select,textarea,button');
                // form.prop("disabled",true);
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var progress = $('.progress-bar');
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        progress.width(percentComplete + '%');
                        progress.html(percentComplete + ' %');
                    }
                }, false);
                return xhr;
            },
            success:function(response){
                alert("Upload Successfull");
                location.reload();
            },
            error:function(error){
                alert(error.responseJSON.message);
            }
        });
    });

</script>
@endsection