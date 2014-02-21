<?php

class PagesController extends BaseController {

	protected $page;

	public function __construct(Page $page)
	{
		$this->page = $page;
	}

	public function getIndex()
	{
		$pages = $this->page->all();

		return View::make('admin.pages.index', compact('pages'));
	}

	public function getCreate()
	{
		$bread = trans('admin.creating');
		$temps = templates::all();
		return View::make('admin.pages.create', compact('temps', 'bread'));
	}

	public function postStore()
	{
		$input = Input::all();

		$validation = Validator::make($input, Page::$rules);

		if ($validation->passes())
		{
			$this->page->create($input);
			
			//return Redirect::route('admin.pages.index');

			return Response::json('success', 200);
		} else {
			return Response::json($validation->getMessageBag()->toJson(), 400);
		}

	}

	public function getShow($id)
	{
		$page = $this->page->findOrFail($id);

		return View::make('admin.pages.show', compact('page'));
	}

	public function getEdit($id)
	{
		$page = $this->page->find($id);
		$bread = trans('admin.editing');

		if (is_null($page))
		{
			return Redirect::route('admin.pages.index');
		}

		return View::make('admin.pages.edit', compact('page', 'bread'));
	}

	public function postUpdate($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Page::$rules);

		if ($validation->passes())
		{
			$page = $this->page->find($id);
			$page->update($input);

			return Response::json('success', 200);
		} else {
			return Response::json($validation->getMessageBag()->toJson(), 400);
		}

	}

	public function postDestroy($id)
	{
		if($this->page->find($id)->delete())
		{
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}

	}

}
