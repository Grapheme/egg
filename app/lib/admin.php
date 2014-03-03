<?php

class admin {

	public static function menuArray()
	{
		return array(
          '' =>           array(trans('admin.dashboard'), 'fa-home',        ''),
          'pages' =>      array(trans('admin.pages'),     'fa-list-alt',    'admin_pages'),
          'galleries' =>  array(trans('admin.galleries'), 'fa-picture-o',   ''),
          'news' =>       array(trans('admin.news'),      'fa-calendar',    'admin_news'),
          'temps' =>      array(trans('admin.templates'), 'fa-edit',        ''),
          'users' =>      array(trans('admin.users'),     'fa-male',        'admin_users'),
          'groups' =>     array(trans('admin.groups'),    'fa-shield',      'admin_users'),
          'languages' =>  array(trans('admin.languages'), 'fa-comments-o',  ''),
          'settings' =>   array(trans('admin.settings'),  'fa-cog',         ''),
          'downloads' =>  array(trans('admin.downloads'), 'fa-cloud-upload','admin_downloads'),
          );
	}

}