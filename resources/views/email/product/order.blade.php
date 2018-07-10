@component('mail::message')
# Introduction

You have a new product order of product  <b>{{$product->name}}</b> . Order is of quantity of <b>{{$details["quantity"]}} </b>.
Order is send by person  <b>{{$details["name"]}}</b> and email is  <b>{{$details["email"]}} </b> .


@component('mail::button', ['url' => route("public.product.show",$product->id)])
View Product
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
