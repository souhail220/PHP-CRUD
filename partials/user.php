<?php
require_once "connect.php";

class User extends Database
{
	protected $tableName = "usertable";

	//function to add users
	public function add($data)
	{
        $fields = "";
        $placeholder = "";
		if (!empty($data)) {
			$fields = $placeholder = [];
			foreach ($data as $field => $value) {
				$fields[] = $field;
				$placeholder[] = ":$field";
			}
		}
		$sql = "INSERT INTO $this->tableName (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholder) . ")";

		$statment = $this->conn->prepare($sql);
		try {
			$this->conn->beginTransaction();
            $statment->execute($data);
			$lastInsertedId = $this->conn->lastInsertId();
			$this->conn->commit();
			return $lastInsertedId;
		} catch (PDOException $e) {
			echo "Error:" . $e->getMessage();
			$this->conn->rollBack();

		}
        return null;
	}

	// function to get rows
	public function getRows($start = 0, $limit = 4)
	{
		$sql = "SELECT * from $this->tableName ORDER BY id DESC LIMIT $start, $limit";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
	}


	// function to get single rows
	public function getRow($field, $value)
	{
		$sql = "SELECT * FROM $this->tableName WHERE $field= :$field";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$field => $value]);
		return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : [];
	}


	// function to count number of rows
	public function getCount()
	{
		$sql = "SELECT count(*) as pCount from $this->tableName";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result["pCount"];
	}


	//function to upload photo
	public function uploadPhoto($file)
	{
		if (!empty($file)) {
			$fileTempPath = $file['tmp_name'];
			$fileName = $file['name'];
			$fileType = $file['type'];
			$fileNameCmps = explode('.', $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
			$allowedExtn = ["png", "jpg", "jpeg"];
			if (in_array($fileExtension, $allowedExtn)) {
				$uploadFileDir = getcwd() . '/uploads/';
				$destFilePath = $uploadFileDir . $newFileName;
				if (move_uploaded_file($fileTempPath, $destFilePath)) {
					return $newFileName;
				}
			}
		}
        return null;
	}


	//function to update
	public function update($data, $id)
	{
        $fields = "";
		if (!empty($data)) {
			$fieldsCount = count($data);
			foreach ($data as $field => $value) {
				$fields .= "$field = :$field";
				if ($fieldsCount > 1) {
					$fields .= ",";
				}
				$fieldsCount--;
			}
		}
		$sql = "UPDATE $this->tableName SET $fields WHERE id=:id";

		$statemnt = $this->conn->prepare($sql);
		try {
			$this->conn->beginTransaction();
			$data['id'] = $id;
            $statemnt->execute($data);
			$this->conn->commit();
		} catch (PDOException $e) {
			echo "Error:" . $e->getMessage();
			$this->conn->rollBack();
		}
	}

	// function to delete


	// function to search
}
