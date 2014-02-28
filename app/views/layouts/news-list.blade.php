@foreach($news as $new)
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><a href="{{slink::to('news/'.$new->id)}}">{{$new->title}}</a></h3>
  </div>
  <div class="panel-body">
    {{$new->preview}}
    <p>{{$new->created_at}}</p>
  </div>
</div>
@endforeach