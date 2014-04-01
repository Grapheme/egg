@foreach($news as $new)
<h2><a href="{{slink::to('news/'.$new->id)}}">{{$new->title}}</a></h2>
<p><span class="glyphicon glyphicon-time"></span> {{ myDateTime::SwapDotDateWithTime($new->created_at) }}</p>
<div>
	{{$new->preview}}
</div>
<a class="btn btn-default" href="{{slink::to('news/'.$new->id)}}">Просмотр <span class="glyphicon glyphicon-chevron-right"></span></a>
@endforeach