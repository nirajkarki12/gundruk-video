@extends('layouts.admin')

@section('title', 'Settings')

@section('content-header', 'Settings')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{'home'}}</a></li>
    <li class="active"><i class="fa fa-gears"></i>Settings</li>
@endsection

@section('content')

    <div class="row">

    @include('notification.notify')
    
    <div class="col-md-12">
        <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#site_settings" data-toggle="tab">Site Settings</a></li>
                    <li><a href="#other_settings" data-toggle="tab">Other Settings</a></li>
                    <li><a href="#social_settings" data-toggle="tab">Social Settings</a></li>
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="site_settings">

                        <form action="{{route('admin.save.settings')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sitename">Site Name</label>
                                        <input type="text" class="form-control" name="site_name" value="{{ Setting::get('site_name')  }}" id="sitename" placeholder="Enter sitename">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tagname">Tags</label>
                                        <input type="text" class="form-control" name="tag_name" value="{{Setting::get('tag_name')  }}" id="tagname" placeholder="Tag Name">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label for="site_logo">Site Logo</label>
                                        <input type="file" id="site_logo" name="site_logo" accept="image/png, image/jpeg">
                                        <p class="help-block">Please enter .png images only.</p>
                                        @if(Setting::get('site_logo'))
                                            <img style="height: 50px;margin-bottom: 15px; border-radius:2em;" src="{{Setting::logo('site_logo')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="site_icon">Site Icon</label>
                                        <input type="file" id="site_icon" name="site_icon" accept="image/png, image/jpeg">
                                        <p class="help-block">Please enter .png images only.</p>
                                        @if(Setting::get('site_icon'))
                                            <img style="height: 50px; margin-bottom: 15px; border-radius:2em;" src="{{Setting::logo('site_icon')}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tagname">Pagination Per Page</label>
                                        <input type="number" class="form-control" name="pagination" value="{{Setting::get('pagination')  }}" id="pagination" placeholder="Number of items to show">
                                    </div>
                                </div>

                          </div>
                          <!-- /.box-body -->

                          
                    </div>

                    <div class="tab-pane" id="other_settings">

                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="streaming_url">Streaming Url</label>
                                        <input type="text" value="{{ Setting::get('streaming_url')}}" class="form-control" name="streaming_url" id="streaming_url" placeholder="Enter Streaming URL">
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                     <div class="form-group">
                                        <label for="uploaddisk">File Upload Disk</label>
                                        <select name="uploaddisk" id="uploaddisk" class="form-control">
                                            <option value="">Select Upload Disk</option>
                                            @foreach($disks as $disk)
                                            <option value="{{$disk['name']}}" {{$disk['name'] == Setting::get('uploaddisk')?'selected':''}}>{{ucfirst($disk['name'])}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiry_days">{{'expiry_days'}}</label>
                                        <input type="text" class="form-control" value="{{Setting::get('expiry_days')  }}" name="expiry_days" id="expiry_days" placeholder="{{'expiry_days'}}" pattern="[0-9]{1,}">
                                    </div>   
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="google_analytics">google_analytics</label>
                                        <textarea class="form-control" id="google_analytics" name="google_analytics">{{Setting::get('google_analytics')}}</textarea>
                                    </div>
                                </div>   

                          </div>
                          <!-- /.box-body -->
                    </div>


                    <div class="tab-pane" id="social_settings">

                            <div class="box-body">
                                <h4>fb_settings</h4>
                                <hr>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fb_client_id">FB_CLIENT_ID</label>
                                        <input type="text" class="form-control" name="FB_CLIENT_ID" id="fb_client_id" placeholder="FB_CLIENT_ID" value="{{Setting::get('FB_CLIENT_ID')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fb_client_secret">FB_CLIENT_SECRET</label>    
                                        <input type="text" class="form-control" name="FB_CLIENT_SECRET" id="fb_client_secret" placeholder="FB_CLIENT_SECRET" value="{{Setting::get('FB_CLIENT_SECRET')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fb_call_back">FB_CALL_BACK</label>    
                                        <input type="text" class="form-control" name="FB_CALL_BACK" id="fb_call_back" placeholder="FB_CALL_BACK" value="{{Setting::get('FB_CALL_BACK')}}">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <h4>twitter_settings</h4>
                                <hr>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="twitter_client_id">TWITTER_CLIENT_ID</label>
                                        <input type="text" class="form-control" name="TWITTER_CLIENT_ID" id="twitter_client_id" placeholder="TWITTER_CLIENT_ID" value="{{Setting::get('TWITTER_CLIENT_ID')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="twitter_client_secret">TWITTER_CLIENT_SECRET</label>    
                                        <input type="text" class="form-control" name="TWITTER_CLIENT_SECRET" id="twitter_client_secret" placeholder="TWITTER_CLIENT_SECRET" value="{{Setting::get('TWITTER_CLIENT_SECRET')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="twitter_call_back">TWITTER_CALL_BACK</label>    
                                        <input type="text" class="form-control" name="TWITTER_CALL_BACK" id="twitter_call_back" placeholder="TWITTER_CALL_BACK" value="{{Setting::get('TWITTER_CALL_BACK')}}">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <h4>google_settings</h4>
                                <hr>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="google_client_id">GOOGLE_CLIENT_ID</label>
                                        <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" id="google_client_id" placeholder="GOOGLE_CLIENT_ID" value="{{Setting::get('GOOGLE_CLIENT_ID')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="google_client_secret">GOOGLE_CLIENT_SECRET</label>    
                                        <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" id="google_client_secret" placeholder="GOOGLE_CLIENT_SECRET" value="{{Setting::get('GOOGLE_CLIENT_SECRET')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="google_call_back">GOOGLE_CALL_BACK</label>    
                                        <input type="text" class="form-control" name="GOOGLE_CALL_BACK" id="google_call_back" placeholder="GOOGLE_CALL_BACK" value="{{Setting::get('GOOGLE_CALL_BACK')}}">
                                    </div>
                                </div>
                                <div class='clearfix'></div>
                            </div>
                           
                    </div>

                </div>

            </div>
                <div class="box-footer">
                    @if(Setting::get('admin_delete_control') == 1) 
                        <button type="submit" class="btn btn-primary" disabled>submit</button>
                    @else
                        <button type="submit" class="btn btn-primary">submit</button>
                    @endif
                </div>
            </form>
        </div>
    
    </div>


@endsection