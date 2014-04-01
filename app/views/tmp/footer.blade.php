			</div>
			<div class="col-lg-4">

			</div>
		</div>
		<footer>
			<div class="row">
				<div class="col-lg-12">
					<p>Copyright &copy; Grapheme 2014</p>
				</div>
			</div>
		</footer>
	</div>
@if(Config::get('app.use_googleapis'))
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{asset('system/js/vendor/jquery.min.js');}}"><\/script>')</script>
@else
	{{HTML::script('system/js/vendor/jquery.min.js');}}
@endif
	<script>if(!window.jQuery.ui){document.write('<script src="{{asset('system/js/vendor/jquery-ui.min.js');}}"><\/script>');}</script>
	{{HTML::script('system/js/vendor/bootstrap.min.js');}}
	{{HTML::script('system/js/libs/base.js');}}
</body>
</html>
