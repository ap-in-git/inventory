<h4 class="page-header">Categories</h4>
<div class="list-group">
    @foreach($sidebar_categories as $category)
    <a class="list-group-item" href="/category/{{$category->id}}"> {{$category->name}} <span class="label label-primary">{{$category->products->count()}}</span></a>


        @endforeach
</div>