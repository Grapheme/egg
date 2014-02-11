<?php

class GalleriesController extends BaseController {

	public function index()
	{
		return View::make('admin.galleries.index');
	}

	public function edit($id)
	{
		$gall = gallery::findOrFail($id);
		return View::make('admin.galleries.edit')->with(array('gall' => $gall, 'upload_dir' => slink::path(Config::get('egg.upload_dir'))."/galleries/" ));
	}

	public function upload()
	{
		$file = Input::file('file');
		$id = Input::get('gallery-id');

		$rules = array(
        	'file' => 'image'
	    );
	 
	    $validation = Validator::make(array('file' => $file), $rules);
	 
	    if ($validation->fails())
	    {
	        return Response::make($validation->errors->first(), 400);
	        exit;
	    }
 
		$destinationPath = public_path().Config::get('egg.upload_dir').'/galleries';
		$extension =$file->getClientOriginalExtension();
		$filename = time().".".$extension; 
		$upload_success = Input::file('file')->move($destinationPath, $filename);
		 
		if( $upload_success ) {
			photo::create(array(
				"name" => $filename,
				"gallery_id" => $id,
			));
		   return Response::json('success', 200);
		} else {
		   return Response::json('error', 400);
		}
	 
	}

	public function deletePhoto() {
		$id = Input::get('id');

		$model = photo::find($id);


		$db_delete = $model->delete();

		if( $db_delete )
		{
			$file_delete = File::delete(public_path().Config::get('egg.upload_dir').'/galleries/'.$model->name);
		}

		if( $db_delete && $file_delete )
		{
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}



}
