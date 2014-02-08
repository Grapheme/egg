<?php

class LangController extends BaseController {

	public function index()
	{
		return View::make('admin.languages');
	}

	public function create()
	{

		$input = Input::all();
		$messages = array(
		    'required' => ':attribute',
		);
		$validation = language::make($input, language::$rules, $messages);

		if ($validation->passes())
		{
			$this->page->create($input);
			
			//return Redirect::route('admin.pages.index');

			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'errors' => $validation->getMessageBag()->toArray()));
		}
	}
}
