@extends("base")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-danger alert-error mb-1" style="display: none;">
                    </div>
                    <form accept-charset="UTF-8" role="form" action="javascript:void(0);" method="post" id="form-login">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="yourmail@example.com" name="email" type="text" id="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="******" name="password" type="password" id="password">
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" id="btn-login">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script src="login.js?v=1.0"></script>
@endsection