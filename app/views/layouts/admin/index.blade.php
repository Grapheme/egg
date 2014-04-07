<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <title> Admin panel </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{ HTML::style('admin_template/css/bootstrap.min.css') }}
    {{ HTML::style('admin_template/css/font-awesome.min.css') }}
    {{ HTML::style('admin_template/css/smartadmin-production_unminified.css') }}
    {{ HTML::style('admin_template/css/smartadmin-skins.css') }}
    {{ HTML::style('system/css/admin/redactor.css') }}
    <link rel="shortcut icon" href="<?=asset('admin_template/img/favicon/favicon.ico')?>" type="image/x-icon">
    <link rel="icon" href="<?=asset('admin_template/img/favicon/favicon.ico')?>" type="image/x-icon">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    @yield('style')
  </head>
  <body class="smart-style-2">
    <header id="header">
      <div id="logo-group">
        <h1 id="logo" style="color: #fff;">Strawberry CMS</h1>
      </div>
      <div class="pull-right">
        <div id="hide-menu" class="btn-header pull-right">
          <span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <div id="logout" class="btn-header transparent pull-right">
          <span> <a href="<?=URL::to('logout')?>" title="Sign Out"><i class="fa fa-sign-out"></i></a> </span>
        </div>
        <div id="search-mobile" class="btn-header transparent pull-right">
          <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div>
      </div>
    </header>
    <aside id="left-panel">
      <nav>
        <ul>
          <?php $options = admin::menuArray(); ?>
          @foreach($options as $url => $option)
          @if(!modules::where('url', $url)->exists())
            @if($option[2] == '' or allow::to($option[2]))
            <li <?php if(slink::segment(2) == $url) echo "class=\"active\"";?> >
              <a href="{{slink::to('admin/'.$url)}}" title="<?=$option[0]?>"><i class="fa fa-lg fa-fw <?=$option[1]?>"></i> <span class="menu-item-parent"><?=$option[0]?></span></a>
            </li>
            @endif
          @endif

          @endforeach
        </ul>
      </nav>
      <span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>
    </aside>
    <div id="main" role="main">
      <div id="content">
        <div class="row">
          <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
              @if(isset($options[slink::segment(2)]))

                @if(slink::segment(3))<a href="{{slink::to('admin/'.slink::segment(2))}}">@endif
                  <i class="fa-fw fa {{$options[slink::segment(2)][1]}}"></i> {{$options[slink::segment(2)][0]}}
                @if(slink::segment(3))</a>@endif

              @endif
              @if(slink::segment(3) != "" && isset($bread))
              <span>&gt; {{$bread}}</span>
              @endif
            </h1>
          </div>
        </div>
        <section id="widget-grid" class="">
          <div class="row">
            <article class="col-sm-12">
              @yield('content')

            </article>

          </div>
        </section>
      </div>
    </div>
    <script data-pace-options='{ "restartOnRequestAfter": true }' src="<?=URL::to('admin_template/js/plugin/pace/pace.min.js')?>"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script>
      if (!window.jQuery) {
        document.write('<script src="<?=URL::to('admin_template/js/libs/jquery-2.0.2.min.js')?>"><\/script>');
      }
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
      if (!window.jQuery.ui) {
        document.write('<script src="<?=URL::to('admin_template/js/libs/jquery-ui-1.10.3.min.js')?>"><\/script>');
      }
    </script>
    <script src="<?=URL::to('admin_template/js/bootstrap/bootstrap.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/notification/SmartNotification.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/smartwidgets/jarvis.widget.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/sparkline/jquery.sparkline.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/jquery-validate/jquery.validate.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/masked-input/jquery.maskedinput.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/select2/select2.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/bootstrap-slider/bootstrap-slider.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/msie-fix/jquery.mb.browser.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/smartclick/smartclick.js')?>"></script>
    <!--[if IE 7]>
		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
    <![endif]-->
    <script src="<?=URL::to('admin_template/js/app.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/flot/jquery.flot.cust.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/flot/jquery.flot.resize.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/flot/jquery.flot.tooltip.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
    <script src="<?=URL::to('admin_template/js/plugin/fullcalendar/jquery.fullcalendar.min.js')?>"></script>
    @yield('plugins')
    <script type="text/javascript">
    $(document).ready(function() {
      pageSetUp();
    })
    </script>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>