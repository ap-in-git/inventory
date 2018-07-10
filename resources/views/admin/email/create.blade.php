@extends("layouts.inventory")

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h2 class="page-header">Send Email </h2>
            <form action="/admin/send-mail" class="form-horizontal" method="post">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <label for="email" class="col-md-2 control-label">To </label>

                    <div class="col-md-10">
                        <input id="email" type="text" class="form-control" name="email" value="{{ $email }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }} ">
                    <label for="message" class="col-md-2 control-label">Message </label>

                    <div class="col-md-10">
                          <textarea name="message" class="form-control "></textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary col-md-offset-11" type="submit">Send Mail</button>
                </div>
            </form>
        </div>
    </div>

    @endsection