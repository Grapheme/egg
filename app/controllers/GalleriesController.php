<?php

class GalleriesController extends BaseController {

	public function index()
	{
		return View::make('admin.galleries.index');
	}

	public function create()
	{

	}
}
