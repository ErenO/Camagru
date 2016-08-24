<?php
	class User
	{
		private $_id;
		private $_name;
		private $_fitstName;
		private $_passwd;
		private $_mail;
		private $_login;

		public function hydrate(array $donnees) {
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method))
				{
					$this ->$method($value);
				}
			}
		}

		public function id() {
			return $this->_id;
		}

		public function name() {
			return $this->_name;
		}

		public function firstName() {
			return $this->_firstName;
		}

		public function login() {
			return $this->_login;
		}

		public function mail() {
			return $this->_mail;
		}

		public function setName($name)
		{
			if (is_string($name) && strlen($name) <= 30)
			{
				$this->_name = $name;
			}
		}

		public function setFirstName($firstName)
		{
			if (is_string($firstName) && strlen($firstName) <= 30)
			{
				$this->firstName = $firstName;
			}
		}

		public function setLogin($login)
		{
			if (is_string($login) && strlen($login) <= 30)
			{
				$this->login = $login;
			}
		}

		public function setMail($mail)
		{
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
			{
				$this->_mail = $mail;
			}
		}

		public function setPasswd($passwd)
		{
			if (!$this->_passwd)
			{
				$passwd = hash('whirlpool', $_POST['passwd']);
			}
		}
	}
?>
