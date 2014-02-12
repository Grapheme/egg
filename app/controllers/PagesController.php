<?php

class PagesController extends BaseController {

	/**
	 * Page Repository
	 *
	 * @var Page
	 */
	protected $page;

	public function __construct(Page $page)
	{
		$this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = $this->page->all();

		return View::make('admin.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.pages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$messages = array(
		    'required' => ':attribute',
		);
		$validation = Validator::make($input, Page::$rules, $messages);

		if ($validation->passes())
		{
			$this->page->create($input);
			
			//return Redirect::route('admin.pages.index');

			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'errors' => $validation->getMessageBag()->toArray()));
		}

		// return Redirect::route('admin.pages.create')
		// 	->withInput()
		// 	->withErrors($validation)
		// 	->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = $this->page->findOrFail($id);

		return View::make('admin.pages.show', compact('page'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = $this->page->find($id);

		if (is_null($page))
		{
			return Redirect::route('admin.pages.index');
		}

		return View::make('admin.pages.edit', compact('page'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$messages = array(
		    'required' => ':attribute',
		);
		$validation = Validator::make($input, Page::$rules, $messages);

		if ($validation->passes())
		{
			$page = $this->page->find($id);
			$page->update($input);

			//return Redirect::route('admin.pages.show', $id);

			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'errors' => $validation->getMessageBag()->toArray()));
		}

		

		// return Redirect::route('admin.pages.edit', $id)
		// 	->withInput()
		// 	->withErrors($validation)
		// 	->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->page->find($id)->delete();

		return 'deleted';
	}

}
