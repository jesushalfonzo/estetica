<?php
class Autocompletar
{

	private $dbh;

	public function __construct()
	{
		$this->dbh = new PDO("mysql:host=localhost;dbname=BD_pixelado", "root", "123456");
	}

	public function findData($search)
	{
		$query = $this->dbh->prepare("SELECT m_paciente_id AS id, m_paciente_nombre AS nombre FROM m_pacientes WHERE m_paciente_estatus='A' AND m_paciente_nombre LIKE :search LIMIT 0,7");
        $query->execute(array(':search' => '%'.$search.'%'));
        $this->dbh = null;
        if($query->rowCount() > 0)
        {
        	echo json_encode(array('res' => 'full', 'data' => $query->fetchAll()));
        }
        else
        {
        	echo json_encode(array('res' => 'empty'));
        }
	}
}