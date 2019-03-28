<?php
namespace controllers{
	
	class Holiday {
		//Atributo para banco de dados
		private $PDO;

		/*
		__construct
		Conectando ao banco de dados
		*/
		function __construct(){
			$this->PDO = new \PDO('mysql:host=localhost;dbname=calendar; charset=UTF8', 'root', ''); //Conexão
			$this->PDO->setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION ); //habilitando erros do PDO
		}
		
		/*
		list holidays in same month as date provided
		param $id
		Gets holiday by id
		*/
		public function listMonth($month, $year){
			global $app;
			$sth = $this->PDO->prepare("SELECT * FROM holidays WHERE MONTH(holidays.date) = :month AND YEAR(holidays.date) = :year OR MONTH(holidays.date) = :month and holidays.type = 0");
			$sth ->bindValue(':month',$month);
			$sth ->bindValue(':year',$year);
			$sth->execute();
			$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
			$app->render('default.php',["data"=>$result],200); 
		}
	}
}