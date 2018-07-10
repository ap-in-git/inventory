<nav class="navbar navbar-default navbar-static-top" style="background: #58a5f0;">
    <div class="container-fluid white-text">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand white-text" href="/" ><img src="{{asset($global_company_details->logo_url)}}" class="img img-responsive"> </a>
        </div>

        <div class="col-sm-4 col-md-4 ">
            <form class="navbar-form " role="search"  method="get" action="/search">
                <div class="input-group full-width">
                    <input type="text" class="form-control " placeholder="Search" name="q" >
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/products" class="white-text"> Products</a></li>
                <li><a href="/about" class="white-text"> About</a></li>
                <li><a href="/contact" class="white-text"> Contact</a></li>
            </ul>
        </div>
    </div>
</nav>