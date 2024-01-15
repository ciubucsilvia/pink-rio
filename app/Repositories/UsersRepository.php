<?php 

namespace Corp\Repositories;

use Corp\User;

class UsersRepository extends Repository{
	
	public function __construct(User $user){

		$this->model = $user;
	}

	public function addUser($request) {
		// if(Gate::denies('save'), $this->model) {
		// 	abort(403, 'Unauthorized action.');
		// }

		$data = $request->all();

		$user = $this->model->create([
			'name' => $data['name'],
			'login' => $data['login'],
			'email' => $data['login'],
			'password' => bcrypt($data['password']),
		]);

		if($user) {
			$user->roles()->attach($data['role_id']);
		}

		return ['status' => 'User added'];
	}

	public function updateUser($request, $user) {
		// if(Gate::denies('save'), $this->model) {
		// 	abort(403, 'Unauthorized action.');
		// }

		$data = $request->all();

		if(isset($data['password'])) {
			$data['password'] = bcrypt($data['password']);
		}

		$user->fill($data)->update();

		$user->roles()->sync($data['role_id']);

		return ['status' => 'User updated'];
	}

	public function deleteUser($user) {
		// if(Gate::denies('destroy'), $this->model) {
		// 	abort(403, 'Unauthorized action.');
		// }

		$user->roles()->detach();

		if($user->delete()) {
			return ['status' => 'User deleted!'];
		}
	}
}

?>