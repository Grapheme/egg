<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">{{$news->title}}</h3>
  </div>
  <div class="panel-body">
    {{spage::render($news->content)}}
    <p>{{$news->created_at}}</p>
  </div>
  <a href="{{URL::previous()}}">&lt;Back</a>
</div>