<li> <a href="#" class="waves-effect"><i class="fa fa-cog fa-fw" data-icon="v"></i> <span class="hidDashboarde-menu"> Setup <span class="fa arrow"></span> </span></a>
    <ul class="nav nav-second-level">

        <li> <a href="{{route("user.index")}}" class="waves-effect"> <span class="hide-menu">User Setup</span></a></li>
        <li> <a href="{{route("category.index")}}" class="waves-effect"> <span class="hide-menu">Category Setup</span></a></li>
        <li> <a href="{{route("subcategory.index")}}" class="waves-effect"> <span class="hide-menu">Subcategory Setup</span></a></li>
        <li> <a href="{{route("size.index")}}" class="waves-effect"> <span class="hide-menu">Size Setup</span></a></li>
        <li> <a href="{{route("quality.index")}}" class="waves-effect"> <span class="hide-menu">Quality Setup</span></a></li>
        <li> <a href="{{route("product.index")}}" class="waves-effect"> <span class="hide-menu">Product Setup</span></a></li>


    </ul>
</li>
<li> <a href="{{route("stock.index")}}" class="waves-effect"><i class="fa fa-suitcase fa-fw" data-icon="v"></i> Current Stock </a></li>
<li> <a href="{{route("transaction.create")}}" class="waves-effect"><i class="fa fa-dollar fa-fw" data-icon="v"></i> Sell item </a></li>
{{--<li> <a href="#" class="waves-effect"><i class="fa fa-money fa-fw" data-icon="v"></i> <span class="hidDashboarde-menu"> Sell <span class="fa arrow"></span> </span></a>--}}
    {{--<ul class="nav nav-second-level">--}}

        {{--<li><a href="{{route("transaction.create")}}" >Item </a> </li>--}}
        {{--<li><a href="{{route("transaction.index")}}" >History </a> </li>--}}
    {{--</ul>--}}
{{--</li>--}}
<li><a href="{{route("order.index")}}"><i class="fa fa-bars"></i> Order Request</a> </li>
<li><a href="{{route("admin.contact.index")}}"><i class="fa fa-envelope"></i> Message</a> </li>
<li> <a href="#" class="waves-effect"><i class="fa fa-calendar fa-fw" data-icon="v"></i> <span class="hidDashboarde-menu"> History <span class="fa arrow"></span> </span></a>
    <ul class="nav nav-second-level">

        <li><a href="{!! route("user.transaction.index") !!}"><i class="fa fa-user">&nbsp;HBW USER TRANSACTION</i> </a> </li>
        <li><a href="{{route("product.transaction.index")}}" >Product Stock</a> </li>
        <li><a href="{{route("transaction.report")}}">Report</a> </li>
        <li><a href="{{route("transaction.index")}}">Sell History</a></li>
    </ul>
</li>

<li><a href="#" class="waves-effect"><i class="fa fa-paper-plane"></i>  <span class="hidDashboarde-menu"> Public <span class="fa arrow"></span> </span> </a>
    <ul class="nav nav-second-level">
        <li><a href="{{route("admin.slider.index")}}">Slider Setup</a> </li>
        <li><a href="{{route("admin.testimonial.index")}}">Testimonial Setup</a> </li>
        <li><a href="{{route("admin.company.detail")}}">Company Detail Setup</a> </li>
        <li><a href="{{route("admin.worker.index")}}">Employee profile Setup</a> </li>
        <li><a href="#" class="waves-effect"><span class="hidDashboarde-menu"></span>About us Setup <span class="fa arrow"></span> </a>
               <ul class="nav nav-third-level">
                   <li><a href="{{route("admin.about")}}">Company Overview setup</a> </li>
                   <li><a href="{{route("admin.core")}}">Company Core about</a> </li>
               </ul>
        </li>

    </ul>

</li>
{{--<li ><a href="{!! route("order.index") !!}">Product Order </a> </li>--}}
{{--<li><a href="{{route("stock.history")}}" >History </a> </li>--}}
