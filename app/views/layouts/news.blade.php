@include('tmp.header')
	 <h1>{{$news->title}}</h1>
	<p><span class="glyphicon glyphicon-time"></span> {{ myDateTime::SwapDotDateWithTime($news->created_at) }}</p>
	<div>
	{{spage::render($news->content)}}
	</div>
	<div>
		<a class="btn btn-default" href="{{URL::previous()}}"><span class="glyphicon glyphicon-chevron-left"></span> Вернуться назад</a>
	</div>
@include('tmp.footer')