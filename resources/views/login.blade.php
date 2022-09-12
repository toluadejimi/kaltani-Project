<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    
</head>

<body style="background: url(img/bg.jpeg); background-repeat: no-repeat; background-attachment: fixed; background-position: center center; background-size: cover; ">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap justify-content-center">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                
                            </div>
                            <form action="/signin" class="signin-form" method="GET">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <div class="form-group mt-5">
                                    <input type="text" class="form-control" required="" name="email">
                                    <label class="form-control-placeholder " for="username">Email</label>
                                </div>
                                <div class="form-group mt-4">
                                    <input id="password-field" type="password" class="form-control" required="" name="password">
                                    <label class="form-control-placeholder " for="password">Password</label>
                                    <span toggle="#password-field"
                                        class="fa fa-fw field-icon toggle-password fa-eye"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    
                                    <div class="w-100 text-md-center text-center">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js+bootstrap.min.js+main.js.pagespeed.jc.3YxqA_kpjO.js"></script>
    <script>
        eval(mod_pagespeed_B48vE68w01);
    </script>
    <script>
        eval(mod_pagespeed_M0XlbbKlq8);
    </script>
    <script>
        eval(mod_pagespeed_DUZ_Pnp2XD);
    </script>
    <script defer=""
        src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon="{&quot;rayId&quot;:&quot;72613674e8af1ead&quot;,&quot;token&quot;:&quot;cd0b4b3a733644fc843ef0b185f98241&quot;,&quot;version&quot;:&quot;2022.6.0&quot;,&quot;si&quot;:100}"
        crossorigin="anonymous">
    </script>


</body>

</html>
