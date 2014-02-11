<?php

class GalleriesController extends BaseController {

	public function index()
	{
		return View::make('admin.galleries.index');
	}

	public function edit($id)
	{
		return View::make('admin.galleries.edit')->with(array('id' => $id));
	}

	public function upload()
	{
		$file = Input::file('file');

		$rules = array(
        	'file' => 'image'
	    );
	 
	    $validation = Validator::make(array('file' => $file), $rules);
	 
	    if ($validation->fails())
	    {
	        return Response::make($validation->errors->first(), 400);
	        exit;
	    }
 
		$destinationPath = public_path().'/public/uploads/galleries';
		$extension =$file->getClientOriginalExtension();
		$filename = time().".".$extension; 
		$upload_success = Input::file('file')->move($destinationPath, $filename);
		 
		if( $upload_success ) {
		   return Response::json('success', 200);
		} else {
		   return Response::json('error', 400);
		}
	 
	}
}
