@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href="{{asset('timeline/css/style.css') }}">
    
    <style>
        .select2-close-mask {
            z-index: 2099;
        }

        .select2-dropdown {
            z-index: 3051;
        }

        span.select2-container {
            z-index: 10050;
        }

    </style>
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        <li class="breadcrumb-item active">Tracking Kredit</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-truck'></i> Tracking Nasabah Kredit
            <small>
                Tampilan Tracking Kredit.
            </small>
        </h1>
    </div>
    
        <section id="timeline-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="timeline-top">
              <div class="top-year">2016</span></div>
    
            </div>
            <div class="timeline-block">
              <div class="timeline-events">
                <br>
                
                <div class="event l-event col-md-6 col-sm-6 col-xs-8 "><span class="thumb fa fa-codepen"></span>
                  <div class=" event-body">
                    <div class="person-image pull-left " style="height: 20%;">
                        <img style="width: 100%;height: 50%;" src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/male3-512.png" alt="person" />
                    </div>
                    <div class="event-content">
                    <h5 class="text-primary text-left">IT-PLUS programming solution </h5>
                    <span class="text-muted text-left" style="display:block; margin: 0"><small>19 October 2016</small></span>
                    <br><br>
                    <blockquote class="text-muted text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat ipsum voluptates sapiente beatae non praesentium vitae dolorum qui, reprehenderit harum <br>
    <cite class="text-muted text-right text-bold">- Alex Martin</cite>
    </blockquote>
    
    </div>
                  </div> <!-- end of event body -->
    <div class="clear-fix"></div>
                </div><!-- end of left event -->
                <div class="row"></div>
                <div class="event r-event col-md-6 col-sm-6 col-xs-8 "><span class="thumb fa fa-facebook"></span>
                  <div class=" event-body">
                    <div class="person-image pull-left " style="height: 20%;">
                        <img style="width: 100%;height: 50%;" src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/male3-512.png" alt="person" /></div>
    <div class="event-content">
    <h5 class="text-primary text-left">IT-PLUS programming solution </h5>
    <span class="text-muted text-left" style="display:block; margin: 0"><small>19 October 2016</small></span>
    <br><br>
                    <blockquote class="text-muted text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat ipsum voluptates sapiente beatae non praesentium vitae dolorum qui, reprehenderit harum <br>
    <cite class="text-muted text-right text-bold">- Alex Martin</cite>
    </blockquote>
    
    </div>
                  </div>
                </div><!-- end of right event <-->
                  <div class="clearfix"></div>
                
                <div class="row"></div>
                
                  <div class="clearfix"></div>
                
                <div class="row"></div>
                <div class="event r-event col-md-6 col-sm-6 col-xs-8 ">
                  <span class="thumb fa fa-codepen"></span>
                 <div class=" event-body">
                    <div class="person-image pull-left " style="height: 20%;">
                        <img style="width: 100%;height: 50%;" src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/male3-512.png" alt="person" /></div>
    <div class="event-content">
    <h5 class="text-primary text-left">IT-PLUS programming solution </h5>
    <span class="text-muted text-left" style="display:block; margin: 0"><small>19 October 2016</small></span>
    <br><br>
                    <blockquote class="text-muted text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat ipsum voluptates sapiente beatae non praesentium vitae dolorum qui, reprehenderit harum <br>
    <cite class="text-muted text-right text-bold">- Alex Martin</cite>
    </blockquote>
                    </div>
    </div>
                </div><!-- end of right event <-->
                  <div class="clearfix"></div>
                </-->
              </div><!-- end of timeline events -->
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </section>
        
    
    
</main>
@endsection
@section('scripts')

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js'></script>

<script src="{{asset('timeline/js/index.js') }}"></script>
<script src="{{asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{asset('assets/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
<script src="{{asset('assets/js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/kredit.js') }}"></script>
