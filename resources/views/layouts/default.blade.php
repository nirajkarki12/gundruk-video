<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@if(Setting::get('site_name')) {{Setting::get('site_name') }} @else Stream Hash @endif</title>

    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/jquery-ui.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/app.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/theme.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/font-awesome.min.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/layerslider/css/layerslider.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/responsive.css')}}">

    <link rel="stylesheet" href="{{asset('vendor/css/style.css')}}">

    <link rel="shortcut icon" href=" @if(Setting::get('site_icon')) {{ Setting::get('site_icon') }} @else {{asset('favicon.png') }} @endif">

    @if(Setting::get('google_analytics'))
        <?php echo Setting::get('google_analytics'); ?>
    @endif

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@if(Setting::get('site_name')) {{Setting::get('site_name') }} @else Stream Hash @endif" />
    <meta property="og:description" content="The best solution to start up a video streaming venture!" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="@if(Setting::get('site_name')) {{Setting::get('site_name') }} @else Stream Hash @endif" />
    <meta property="og:image" content="{{Setting::get('site_icon')}}" />

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="The best solution to start up a video streaming venture!"/>
    <meta name="twitter:title" content="@if(Setting::get('site_name')) {{Setting::get('site_name') }} @else Stream Hash @endif"/>
    <meta name="twitter:image:src" content="@if(Setting::get('site_icon')) {{ Setting::get('site_icon') }} @else {{asset('favicon.png') }} @endif"/>

    <style type="text/css">
        .ui-autocomplete{
          z-index: 99999;
        }
    </style>

    @yield('styles')

</head>

<body>

    <div class="off-canvas-wrapper">

        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

            <!--header-->

            <!--- Responsive header -->

            @include('layouts.user.responsive-header')

            <!--off-canvas position-left light-off-menu end-->

            <div class="off-canvas-content" data-off-canvas-content>

                @include('layouts.user.header')

                <!-- End Header -->

                <!-- layerslider -->

                <!--end slider-->

                @yield('content')

                <!-- End main content -->

                @include('layouts.user.footer')

            </div>

            <!--end off canvas content-->

        </div>

        <!--end off canvas wrapper inner-->

    </div>

    <!--end off canvas wrapper-->

    <!-- script files -->
    <script src="{{asset('vendor/bower_components/jquery/dist/jquery.js')}}"></script>

    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/jquery-ui.js')}}"></script>

    <script src="{{asset('vendor/bower_components/what-input/what-input.js')}}"></script>
    <script src="{{asset('vendor/bower_components/foundation-sites/dist/foundation.js')}}"></script>
    <script src="{{asset('vendor/js/jquery.showmore.src.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/js/app.js')}}"></script>
    <script src="{{asset('vendor/layerslider/js/greensock.js')}}" type="text/javascript"></script>

    <!-- LayerSlider script files -->
    <script src="{{asset('vendor/layerslider/js/layerslider.transitions.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/layerslider/js/layerslider.kreaturamedia.jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('vendor/js/inewsticker.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/js/jquery.kyco.easyshare.js')}}" type="text/javascript"></script>

    @yield('scripts')

    <script type="text/javascript">
        @if($page) jQuery("#{{$page}}").addClass("active"); @endif
        @if($subPage) jQuery("#{{$subPage}}").addClass("active"); @endif
    </script>

    <script type="text/javascript">

        jQuery(document).ready( function () {
            //autocomplete
            jQuery("#auto_complete_search").autocomplete({
                source: "{{route('search')}}",
                minLength: 1,
                select: function(event, ui){

                    // set the value of the currently focused text box to the correct value

                    if (event.type == "autocompleteselect"){

                        // console.log( "logged correctly: " + ui.item.value );

                        var username = ui.item.value;

                        if(ui.item.value == 'View All') {

                            // console.log('View AALLLLLLLLL');

                            window.location.href = "{{route('search-all', array('key' => 'all'))}}";

                        } else {
                            // console.log("User Submit");

                            jQuery('#auto_complete_search').val(ui.item.value);

                            jQuery('#userSearch').submit();
                        }

                    }
                }      // select

            });

            jQuery("#responsive_auto_complete_search").autocomplete({
                source: "{{route('search')}}",
                minLength: 1,
                select: function(event, ui){

                    // set the value of the currently focused text box to the correct value

                    if (event.type == "autocompleteselect"){

                        // console.log( "logged correctly: " + ui.item.value );

                        var username = ui.item.value;

                        if(ui.item.value == 'View All') {

                            // console.log('View AALLLLLLLLL');

                            window.location.href = "{{route('search', array('q' => 'all'))}}";

                        } else {
                            // console.log("User Submit");

                            jQuery('#auto_complete_search').val(ui.item.value);

                            jQuery('#userSearch').submit();
                        }

                    }
                }      // select

            });

        });

    </script>


</body>
</html>
