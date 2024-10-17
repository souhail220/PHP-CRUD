<?php
//print_r($_POST);
//die;

$action = $_REQUEST["action"];
//print_r($action);

if (!empty($action)) {
	require_once 'partials/user.php';
	$user = new User();

	// adding user action

	if ($action == 'adduser' && !empty($_POST)) {
		$name = $_POST['username'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$userPhoto = $_FILES['userPhoto'];

		$playerId = !empty($_POST['userId']) ? $_POST['userId'] : "";
        

		$imageName = "";
		if (!empty($userPhoto['name'])) {
			$imageName = $user->uploadPhoto($userPhoto);
			$playerData = [
				'name' => $name,
				'email' => $email,
				'mobile' => $mobile,
				'photo' => $imageName
			];
		} else {
			$playerData = [
				'name' => $name,
				'email' => $email,
				'mobile' => $mobile,
			];
		}
		if ($playerId) {
			$user->update($playerData, $playerId);
		} else {
			$playerId = $user->add($playerData);
		}


		if (!empty($playerId)) {
			$player = $user->getRow('id', $playerId);
			header('Content-Type: application/json');
			echo json_encode([
				'success' => true,
				'message' => 'User added successfully!',
				'data' => $player
			]);
		}
	}


	// get countOf function & getAllUser action

	else if ($action == "getAllUsers") {
		$page = !empty($_GET['page']) ? $_GET['page'] : 1;

		$limit = 4;
		$start = ($page - 1) * $limit;
		$users = $user->getRows($start, $limit);

		$usersList = !empty($users) ? $users : [];
		$userArr = ['count' => $user->getCount(), 'users' => $usersList];

		header("Content-Type: application/json");
		echo json_encode([
			'success' => true,
			'message' => "Data fetched successfully",
			'data' => $usersList,
			'count' => $userArr['count']
		]);
	}

	// action to perform editing
	else if ($action == "editUserData") {
		$playerId = !empty($_GET['id']) ? $_GET['id'] : "";
		if (!empty($playerId)) {
			$player = $user->getRow('id', $playerId);
			header('Content-Type: application/json');
			echo json_encode([
				'success' => true,
				'message' => 'User updated successfully!',
				'data' => $player
			]);
			exit();
		}
	} else {
		header('Content-Type: application/json');
		echo json_encode([
			'success' => false,
			'message' => 'Invalid action'
		]);
	}
	exit();
}
