<?php

class SettingsController extends BaseController {

	public function getIndex()
	{
		$settings = settings::retArray();
		$languages = language::retArray();
		return View::make('admin.settings.index', array('settings' => $settings, 'languages' => $languages));
	}

	public function postAdminlanguagechange()
	{
		$id = Input::get('id');
		$model = settings::where('name', 'admin_language')->first();
		$model->value = language::find($id)->code;
		$model->save();
	}

	public function postModuleon()
	{
		$url = Input::get('url');
		modules::create(array(
			'url' => $url
		));
	}

	public function postModuleoff()
	{
		$url = Input::get('url');
		$module = modules::where('url', $url)->first();
		$module->delete();
	}
}
