<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Login page</title>

    <!-- Core CSS - Include with every page -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    @if (Session::has('message'))
                        <div class="flash alert">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('role' => 'form', route('login'))) }}
                            <fieldset>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <input style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;" class="form-control" placeholder="User" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input style="border-top-left-radius: 0; border-top-right-radius: 0; border-top: 0;" class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!--<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>-->
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" href="index.html" class="btn btn-block btn-primary" value="Login">
                            </fieldset>
                        {{ Form::close() }}
                        @if ($errors->any())
                            <ul>
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

</body>

</html>
