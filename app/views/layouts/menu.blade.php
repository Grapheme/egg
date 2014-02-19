<ul class="nav navbar-nav">

	@foreach($menu as $url => $name)

		<li><a href="{{slink::to($url)}}">{{$name}}</a></li>

	@endforeach

</ul>