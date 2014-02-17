<?php

class UsersController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.users.index');
	}
}
