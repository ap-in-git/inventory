    @if(Session::has("success"))
    <div class="row " style="margin-top: 5px;margin-bottom: 5px;">
    <div class="col-sm-12">
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong>&nbsp; {!! Session::get("success") !!}
        </div>
    </div>
  </div>

        @endif


        @if(Session::has("warning"))
        <div class="row" style="margin-top:5px; margin-bottom:5px;">
          
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong>&nbsp; {!! Session::get("warning") !!}
        </div>
    </div>
    </div>
        @endif
