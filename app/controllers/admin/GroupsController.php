<?php

class GroupsController extends BaseController {

	/**
	 * Group Repository
	 *
	 * @var Group
	 */
	protected $group;

	public function __construct(Group $group)
	{
		$this->beforeFilter('admin_users');
		$this->group = $group;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$groups = $this->group->all();
		$roles = role::all();

		return View::make('admin.groups.index', compact('groups', 'roles'));
	}

	public function getEdit($id)
	{
		$group = $this->group->find($id);
		$roles = role::all();

		return View::make('admin.groups.edit', compact('group', 'roles'));
	}

	public function postAttach()
	{
		$group_id = Input::get('group_id');
		$role_id = Input::get('role_id');

		$group = group::find($group_id);
		$group->roles()->attach($role_id);
	}

	public function postDetach()
	{
		$group_id = Input::get('group_id');
		$role_id = Input::get('role_id');
		
		$group = group::find($group_id);
		$group->roles()->detach($role_id);
	}

}
