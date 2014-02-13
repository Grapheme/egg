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
			Schema::table('pages', function($table)
			{
			    $table->string('title_'.Input::get('code'))->default(null);
				$table->text('description_'.Input::get('code'))->default(null);
				$table->text('keywords_'.Input::get('code'))->default(null);
				$table->mediumText('content_'.Input::get('code'))->default(null);

			});
			return Response::json('success', 200);
		}
	}

	public function delete()
	{
		$id = Input::get('id');
		$model = language::find($id);

		$code = $model->code;

		if($model->delete())
		{
			Schema::table('pages', function($table) use ($code)
			{
			    $table->dropColumn('title_'.$code);
				$table->dropColumn('description_'.$code);
				$table->dropColumn('keywords_'.$code);
				$table->dropColumn('content_'.$code);
			});
			
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}
}