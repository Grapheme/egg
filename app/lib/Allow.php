<?php

class Allow {

	public static function to($perm)
	{
		if(Auth::check())
		{
			$groups = User::find(Auth::user()->id)->groups;
			foreach($groups as $group)
			{
				$id = $group->id;
				$roles = Group::find($id)->roles;
				foreach($roles as $role)
				{
					$roleArray[] = $role->name;
				}
			}

			if(isset($roleArray)){
				if(in_array($perm, $roleArray))
				{
					return true;
					
				} else { return false; }
			} else { return false; }
		} else { return false; }
	}
}