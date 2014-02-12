<?php

class GalleriesController extends BaseController {

	public function index()
	{
		return View::make('admin.galleries.index', array('galls' => gallery::all()));
	}

	public function edit($id)
	{
		$gall = gallery::findOrFail($id);
		return View::make('admin.galleries.edit', array('gall' => $gall));
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
	        return Response::json('This extension is not allowed', 400);
	        exit;
	    }
 
		$destinationPath = public_path().Config::get('egg.galleries_photo_dir');
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
			$file_delete = File::delete(public_path().Config::get('egg.galleries_photo_dir').'/'.$model->name);
		}

		if( $db_delete && $file_delete )
		{
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}

	public function create()
	{
		$input = Input::all();
		$validation = Validator::make($input, gallery::getRules());
		if($validation->fails())
		{
			return Response::json($validation->messages()->toJson(), 400);
		} else {
			$id = gallery::create($input)->id;
			$href = slink::to('admin/galleries/'.$id.'/edit');
			return Response::json($href, 200);
		}
	}

	public function delete()
	{
		$id = Input::get('id');
		$model = gallery::find($id);

		if($model->delete())
		{
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}

}
