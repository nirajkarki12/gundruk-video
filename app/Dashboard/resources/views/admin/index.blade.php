<?php
use  Carbon\Carbon;
?>
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content-header', 'Dashboard')

@section('breadcrumb')
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

<style type="text/css">
  .center-card{
    	width: 30% !important;
	}
  .small-box .icon {
    top: 0px !important;
  }
</style>

@section('content')

	<div class="row">

		<!-- Total Users -->

		<div class="col-lg-3 col-xs-6">

          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>{{ $user_count}}</h3>
              		<p>total_users</p>
            	</div>
            	
            	<div class="icon">
              		<i class="fa fa-user"></i>
            	</div>

          	</div>
        </div>

		<!-- Total Moderators -->

        <div class="col-lg-3 col-xs-6">

          	<div class="small-box bg-red">
            	<div class="inner">
              		<h3>20</h3>
              		<p>total_moderator</p>
            	</div>
            	
            	<div class="icon">
              		<i class="fa fa-users"></i>
            	</div>

            	
          	</div>
        
        </div>

        <div class="col-lg-3 col-xs-6">

          	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3>30</h3>
              		<p>total_videos</p>
            	</div>
            	
            	<div class="icon">
              		<i class="fa fa-video-camera"></i>
            	</div>

            	
          	</div>
        
        </div>

        <div class="col-lg-3 col-xs-6">

            <div class="small-box label-primary">
                <div class="inner">
                    <h3>$ 15</h3>
                    <p>total_revenue</p>
                </div>
                
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>

            </div>
        
        </div>


	</div>

    <div class="row">
        <div class="col-md-8">
            <div class="box">

                <div class="box-header with-border">
                    
                    <h3 class="box-title">daily_view_count</h3>

                    <div class="box-tools pull-right">
                        
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        
                       <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>last_10_days</strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="dailyChart" style="height: 300px;"></canvas>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                
                </div>
                <!-- ./box-body -->

            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-4">
            <div class="box">

                <div class="box-header with-border">
                    
                    <h3 class="box-title">registered_users</h3>

                    <div class="box-tools pull-right">
                        
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                    </div>
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12">
                            <p class="text-center">
                                <strong></strong>
                            </p>
                            
                            <div class="chart-responsive">
                                <canvas id="registerChart" height="200px"></canvas>
                            </div>
                        </div>
                    </div>
                
                </div>

            </div>                          
                        
            
        </div>

        <!-- /.col -->
    </div>

@endsection


@section('scripts')

@endsection