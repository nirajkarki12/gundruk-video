<div class="col-md-12">
@if(Session::has('flash_errors'))
   @if(is_array(Session::get('flash_errors')))
      <div class="alert alert-danger">
         <ul>
             @foreach(Session::get('flash_errors') as $errors)
               @if(is_array($errors))
                  @foreach($errors as $error)
                      <li> {{$error}} </li>
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  @endforeach
               @else
                  <li> {{$errors}} </li>
                  <button type="button" class="close" data-dismiss="alert">×</button>
               @endif
             @endforeach
         </ul>
      </div>
   @else
     <div class="alert alert-danger">
         {{Session::get('flash_errors')}}
         <button type="button" class="close" data-dismiss="alert">×</button>
     </div>
   @endif
@endif

@if(Session::has('flash_error'))
   <div class="alert alert-danger">
     {{Session::get('flash_error')}}
     <button type="button" class="close" data-dismiss="alert">×</button>
   </div>
@endif

@if(Session::has('flash_success'))
   <div class="alert alert-success">
     {{Session::get('flash_success')}}
     <button type="button" class="close" data-dismiss="alert">×</button>
   </div>
@endif
</div>
