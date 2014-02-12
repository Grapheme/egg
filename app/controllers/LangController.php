<?php

class LangController extends BaseController {

	public function index()
	{
		return View::make('admin.languages.index', array('langs' => language::all()));
	}

	public function create()
	{
		$input = Input::all();
		$validation = Validator::make($input, language::getRules());
		if($validation->fails())
		{
			return Response::json($validation->messages()->toJson(), 400);
		} else {
			language::create($input);
			return Response::json('success', 200);
		}
	}

	public function delete()
	{
		$id = Input::get('id');
		$model = language::find($id);

		if($model->delete())
		{
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}
}