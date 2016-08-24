<?php
class userManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}
	public function add(User $perso)
	{
		$q = $this->_db->prepare('INSERT INTO users SET name = :name, firstName = :fistName, passwd = :passwd,
		sexe = :sexe, zipCode = :zipCode, mail = :mail, birthDay = :birthDay');
		$q->bindValue(':name', $perso->nom());
		$q->bindValue(':fistName', $perso->prenom());
		$q->bindValue(':age', $perso->age(), PDO::PARAM_INT);
		$q->bindValue(':mail', $perso->mail());
		$q->bindValue(':adresse', $perso->mail());
		$q->bindValue(':login', $perso->login());
		$q->bindValue(':passwd', $perso->passwd());
		$q->bindValue(':zipCode', $perso->passwd(), PDO::PARAM_INT);
		$q->bindValue(':country', $perso->passwd());
		$q->bindValue(':sexe', $perso->passwd(), PDO::PARAM_BOOL);
		$q->bindValue(':birthDay', $perso->passwd());
		$q->bindValue(':admin', $perso->passwd());
		$q->bindValue(':rights', $perso->passwd(), PDO::PARAM_BOOL);
		$q->execute;
	}

	public function delete(User $perso)
	{
		$this->_db->exec('DELETE FROM personnages WHERE id = ' . $perso->id());
	}

	// public function get($id)
	// {
	// 	$id = (int) $id;
	// 	$q = $this->_db->query('SELECT id, nom, forcePerso, degats,
	// 	niveau, experience FROM personnages WHERE id = '.$id);
	// 	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	// 	return new User($donnees);
	// }
	//
	// public function getList()
	// {
	// 	$persos = array();
	// 	$q = $this->_db->query('SELECT id, nom, prenom, login,
	// 	adresse, mail FROM personnages ORDER BY nom');
	// 	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
	// 	{
	// 		$persos[] = new User($donnees);
	// 	}
	// 	return $persos;
	// }

	// public function update(User $perso)
	// {
	// 	$q = $this->_db->prepare('UPDATE personnages SET forcePerso = :forcePerso , degats = :degats , niveau = :niveau ,
	// 	experience = :experience WHERE id = :id');
	// 	$q->bindValue(':forcePerso', $perso->forcePerso(), PDO:: PARAM_INT);
	// 	$q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
	// 	$q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
	// 	$q->bindValue(':experience', $perso->experience(), PDO:: PARAM_INT);
	// 	$q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
	// 	$q->execute();
	// }
	public function setDb(PDO $db)
	{
		$this ->_db = $db;
	}
}
?>
