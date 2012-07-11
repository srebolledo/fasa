<?php
class ReportsController extends AppController {

	var $uses = array("Tworeport","Onereport","Filial","Cartastate","Ideasstate","Position","Unity","Emsefor","Engineer","Proyectostate");
	
	function index() {
		
		$this->Unity->recursive = 0;
		$this->set('unities', $this->paginate());
		parent::loguea($this->data,$this->here);
	}
	
	function reporte($etapa = null, $fechaIni = null, $fechaFin = null){
		$this->set('title_for_layout','Sistema de reportes | Reporte total');
		if($etapa != null){
			switch($etapa){
				case 2:
						$fase = 2;
						$fecha = '<';
						$this->set('title_for_layout','Sistema de reportes | Reporte fase 2');
						break;
				case 3:
						$fase = 3;
						$fecha = '>';
					$this->set('title_for_layout','Sistema de reportes | Reporte fase 3');
						break;
				default:
					$this->set('title_for_layout','Sistema de reportes | Reporte total');
					break;
			}
				
		}
	
		
//		$this->set('title_for_layout','Sistema de reportes | Reporte');
		if(isset($fecha)){
		$reunionesTotales  = $this->Tworeport->find("count",array('conditions'=>'Tworeport.fecha '.$fecha."'2011-06-01'"));
		}
		else{
		$reunionesTotales  = $this->Tworeport->find("count");
		}
		if(isset($fase)){
		$ingenieros = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<>5",'Engineer.fase'=>$fase)));
		$this->Engineer->recursive = -1;
		$ingenierosNombre = $this->Engineer->find("all",array("conditions"=>array("Engineer.filial_id<>5",'Engineer.fase'=>$fase)));
		}
		else{
		$ingenieros = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<>5")));
		$this->Engineer->recursive = -1;
		$ingenierosNombre = $this->Engineer->find("all",array("conditions"=>array("Engineer.filial_id<>5")));
		}
		
		
		$ingenierosNombre1 = array();
		foreach($ingenierosNombre as $value){
			$ingenierosNombre1[$value['Engineer']['id']] = $value['Engineer']['nombre']." ".$value['Engineer']['apellido'];
		}

		$actividades = array(6,11,9,10);
		//planificacion, taller, grupo evaluador, GRUPO MEJORA
		$filiales = $this->Filial->find("list",array("conditions"=>array("Filial.id <= "=>3)));
		$ingFilial = array();
		//pr($filiales);
		foreach($filiales as $key=>$value){
			if(isset($fase)){
			$ingFilial[$key] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id"=>$key,'Engineer.fase'=>$fase)));
			}
			else{
			$ingFilial[$key] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id"=>$key)));
			}
			
		}
		
		$cuentasdereporte= array();
		$sumaActividades = array();
		$sumaActividades[0] = "Totales";
		$sumaActividades[6] = 0;
		$sumaActividades[11] = 0;
		$sumaActividades[9] = 0;
		$sumaActividades[10] = 0;
		$sumaActividades[12] = 0;
		foreach($ingFilial as $k => $v){
				foreach($v as $key=>$value){
		//			$cuentasdereporte[$key][0] = $this->requestAction("/engineers/getName/".$key);
					$cuentasdereporte[$key][0] = $ingenierosNombre1[$key];
					$suma = 0;
					foreach ($actividades as $a){
					if(isset($fecha)){
					$cuentasdereporte[$key][$a] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$key,"Tworeport.activity_id"=>$a,"Tworeport.state_id" => 2,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					}
					else{
					$cuentasdereporte[$key][$a] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$key,"Tworeport.activity_id"=>$a,"Tworeport.state_id" => 2)));
					
					}
					$suma += $cuentasdereporte[$key][$a];
					$sumaActividades[$a] += $cuentasdereporte[$key][$a];
				}
					$cuentasdereporte[$key][12] = $suma;
					$sumaActividades[12] +=$suma;
			}
			

		}
		array_push($cuentasdereporte,$sumaActividades);
		

		$this->set("reporte2",$cuentasdereporte);
		$this->set("totalreporte2",$reunionesTotales);
	
		if(isset($fecha)){
			$ideasTotales = $this->Onereport->find("count",array('conditions'=>array('Onereport.fecha '.$fecha."'2011-06-01'")));
		
		}
		else{
			$ideasTotales = $this->Onereport->find("count");
		}	
		$estadoideas = $this->Ideasstate->find("list");
		//pr($estadoideas);
		$cuentasdeideas = array();
		foreach($ingenieros as $key=>$value){
			foreach($estadoideas as $k=>$v){
			if(isset($fecha)){
				$cuentasdeideas[$key][$k] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>$k,'Onereport.fecha '.$fecha."'2011-06-01'")));
			}
			else{
				$cuentasdeideas[$key][$k] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>$k)));
			}
			

			}
			
		}

		//pr($cuentasdeideas);

		
		//pr($ingFilial);
		$ingFilialIdeas = $ingFilial;
		$ingFilialReportes = $ingFilial;

		foreach($ingFilialIdeas as $key=>&$value){
			foreach($value as $k=>&$v){
				$value[$k] = $cuentasdeideas[$k];


			}
			
		}
		//pr($ingFilialIdeas);
		$ingIdeas = array();
		$suma1 =0;
		$suma2=0;
		$suma3 = 0;
		$suma4=0;
		foreach($ingFilialIdeas as $key=>&$value){
			foreach($value as $k=>&$v){
				
		//		$tmp = array($this->requestAction("/engineers/getName/".$k),$v[1],$v[2],$v[3],$v[4],$v[1]+$v[2]+$v[3]+$v[4]);
				$tmp = array($ingenierosNombre1[$k],$v[1],$v[2],$v[3],$v[4],$v[1]+$v[2]+$v[3]+$v[4]);
				$suma1 += $v[1];
				$suma2 += $v[2];
				$suma3 += $v[3];
				$suma4 += $v[4];
				
				array_push($ingIdeas,$tmp);
				//pr($v);


			}
			
		}
		//pr($ingIdeas);
		$sumas = array();
		array_push($sumas,"Total",$suma1,$suma2,$suma3,$suma4,$suma1+$suma2+$suma3+$suma4);
		array_push($ingIdeas,$sumas);

		$this->set("ingIdeas",$ingIdeas);

		
		


		foreach($ingFilialReportes as $key=>&$value){
			foreach($value as $k=>&$v){
				//echo $k." ";
				$value[$k] = $cuentasdereporte[$k];
				
			}
			
		}
//FIXME
/*
			$uno=0;
			$dos=0;
			$tres =0;
			$cuatro=0;
		$filialReportes = array();

		pr($ingFilialReportes);
		for($i=1;$i<=3;$i++){
				
			pr($ingFilialReportes[$i]);
			$nombre = $this->requestAction("/filials/getName/".$i);
			$uno = 0;
			$dos = 0;
			$tres = 0;
			$cuatro = 0;
			foreach($ingFilialReportes[$i] as $key=>$v){
				
				echo $ingFilialReportes[$i][$key][0];
				pr($v);
				$uno += $v[6];
				$dos += $v[11];
				$tres += $v[9];
				$cuatro += $v[10];
	
				
			}
			array_push($filialReportes,$nombre,$uno,$dos,$tres,$cuatro);

		}		
		


		pr($filialReportes);
*/
//FIXME

		//pr($filialReportes);

		$filialReportes=array();
		$filialReportes[0][0] = $filiales[1];
		$filialReportes[0][1] = $ingFilialReportes[1][2][6]+$ingFilialReportes[1][3][6]+$ingFilialReportes[1][4][6];
		$filialReportes[0][2] = $ingFilialReportes[1][2][11]+$ingFilialReportes[1][3][11]+$ingFilialReportes[1][4][11];
		$filialReportes[0][3] = $ingFilialReportes[1][2][9]+$ingFilialReportes[1][3][9]+$ingFilialReportes[1][4][9];
		$filialReportes[0][4] = $ingFilialReportes[1][2][10]+$ingFilialReportes[1][3][10]+$ingFilialReportes[1][4][10];
		$filialReportes[0][5] = $filialReportes[0][1] + $filialReportes[0][2] +$filialReportes[0][3] +$filialReportes[0][4];

		$filialReportes[1][0] = $filiales[2];
		$filialReportes[1][1] = $ingFilialReportes[2][1][6]+$ingFilialReportes[2][5][6];
		$filialReportes[1][2] = $ingFilialReportes[2][1][11]+$ingFilialReportes[2][5][11];
		$filialReportes[1][3] = $ingFilialReportes[2][1][9]+$ingFilialReportes[2][5][9];
		$filialReportes[1][4] = $ingFilialReportes[2][1][10]+$ingFilialReportes[2][5][10];
		$filialReportes[1][5] = $filialReportes[1][1] + $filialReportes[1][2] +$filialReportes[1][3] +$filialReportes[1][4];

		$filialReportes[2][0] = $filiales[3];
		$filialReportes[2][1] = $ingFilialReportes[3][6][6];
		$filialReportes[2][2] = $ingFilialReportes[3][6][11];
		$filialReportes[2][3] = $ingFilialReportes[3][6][9];
		$filialReportes[2][4] = $ingFilialReportes[3][6][10];
		$filialReportes[2][5] = $filialReportes[2][1] + $filialReportes[2][2] +$filialReportes[2][3] +$filialReportes[2][4];

		$filialReportes[3][0] = "Totales";
		$filialReportes[3][1] = $ingFilialReportes[1][2][6]+$ingFilialReportes[1][3][6]+$ingFilialReportes[1][4][6] + $ingFilialReportes[2][1][6]+$ingFilialReportes[2][5][6] +$ingFilialReportes[3][6][6];
		$filialReportes[3][2] = $ingFilialReportes[1][2][11]+$ingFilialReportes[1][3][11]+$ingFilialReportes[1][4][11] + $ingFilialReportes[2][1][11]+$ingFilialReportes[2][5][11] +$ingFilialReportes[3][6][11];
		$filialReportes[3][3] = $ingFilialReportes[1][2][9]+$ingFilialReportes[1][3][9]+$ingFilialReportes[1][4][9]+$ingFilialReportes[2][1][9]+$ingFilialReportes[2][5][9]+$ingFilialReportes[3][6][9];
		$filialReportes[3][4] = $ingFilialReportes[1][2][10]+$ingFilialReportes[1][3][10]+$ingFilialReportes[1][4][10]+$ingFilialReportes[2][1][10]+$ingFilialReportes[2][5][10]+$ingFilialReportes[3][6][10];
		$filialReportes[3][5] = $filialReportes[3][1] + $filialReportes[3][2] +$filialReportes[3][3] +$filialReportes[3][4];


		





		$filialIdeas = array();
		$suma1=0;
		$suma2=0;
		$suma3=0;
		$suma4=0;
		$suma5=0;

		foreach($ingFilialIdeas as $key=>&$value){
			$filialIdeas[$key]= array(0=>$filiales[$key],1=>0,2=>0,3=>0,4=>0);
			$filialIdeas[$key][1] = 0;
			$filialIdeas[$key][2] = 0;
			$filialIdeas[$key][3] = 0;
			$filialIdeas[$key][4] = 0;
			$filialIdeas[$key][5] = 0;			
			foreach($value as $k=>$v){
				//pr($v);

				$filialIdeas[$key][1] += $v[1];
				$filialIdeas[$key][2] += $v[2];
				$filialIdeas[$key][3] += $v[3];
				$filialIdeas[$key][4] += $v[4];

				$suma1 += $v[1];
				$suma2 += $v[2];
				$suma3 += $v[3];
				$suma4 += $v[4];

			
			}
			$filialIdeas[$key][5] = $filialIdeas[$key][1]+$filialIdeas[$key][2]+$filialIdeas[$key][3]+$filialIdeas[$key][4];

		
		}
		$sumas = array();
		array_push($sumas,"Total",$suma1,$suma2,$suma3,$suma4,$suma1+$suma2+$suma3+$suma4);
		array_push($filialIdeas,$sumas);
		$estadoProyectos = $this->Proyectostate->find("list",array("conditions"=>array("Proyectostate.id<6")));
		$this->set("estadoProyectos",$estadoProyectos);
		$eProyecto = array();
		$totales = array();
		$suma1 =0;
		$suma2 =0;
		$suma3 =0;
		$suma4 =0;
		$suma5 = 0;

		foreach($ingFilial as $k=>$v){
			$uno = 0;
			$dos = 0;
			$tres = 0;
			$cuatro = 0;
			$cinco = 0;

			foreach($v as $kk=>$vv){

				$i=0;
				
				if(isset($fecha)){
					$uno += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>1,"Onereport.ideasstate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));
					$dos += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>2,"Onereport.ideasstate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));	
					$tres += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>3,"Onereport.ideasstate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));
					$cuatro += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>4,"Onereport.ideasstate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));	
					$cinco += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>6,"Onereport.ideasstate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));	
				}
				else{
					$uno += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>1,"Onereport.ideasstate_id"=>2)));
					$dos += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>2,"Onereport.ideasstate_id"=>2)));	
					$tres += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>3,"Onereport.ideasstate_id"=>2)));
					$cuatro += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>4,"Onereport.ideasstate_id"=>2)));	
					$cinco += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>6,"Onereport.ideasstate_id"=>2)));	
				}
				
					$i++;
				



			}

				$eProyecto[$k] = array(0=>$filiales[$k],1=>$uno,2=>$cinco,3=>$dos,4=>$tres,5=>$cuatro,6=>$uno+$dos+$tres+$cuatro+$cinco);
				$suma1 += $uno;
				$suma2 += $dos;
				$suma3 += $tres;
				$suma4 += $cuatro;
				$suma5 += $cinco;
		}
		$sumas = array();
		array_push($sumas,"Total",$suma1,$suma5,$suma2,$suma3,$suma4,$suma1+$suma2+$suma3+$suma4+$suma5);
		array_push($eProyecto,$sumas);
		$this->set("eProyecto",$eProyecto);



/////// Reporte de realizadas no realizadas replanificadas por ingeniero en taller,planificacion, grupo de {mejora,evaluador}
	$i=1;
	$j=1;
	foreach($ingFilial as $k => $v){
		foreach($v as $key=>$val){
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Talleres"; 
				if(isset($fecha)){
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'")));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Planificación";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'")));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'")));	

				$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo Evaluador";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'")));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'")));	


					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo de Mejora";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'")));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'")));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'")));	
				$i=1;
				$j=1;

				}
				
				else{
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>2)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>3)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>4)));
					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Planificación";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>2)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>3)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>4)));	

				$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo Evaluador";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>2)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>3)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>4)));	


					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo de Mejora";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>2)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>3)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>4)));	
				$i=1;
				$j=1;

				
				}
				
		}
	}
		$nuevasPlanificaciones = array();
		$nuevasPlanificaciones[0] = array();
		$nuevasPlanificaciones[1] = array();
		$nuevasPlanificaciones[2] = array();
		$nuevasPlanificaciones[3] = array();
		$arraySumas = array();
		$arraySumas[0] = "Subtotal";
		foreach($planificaciones as $p){
			$sumaP = 0;
			$sumaR = 0;
			$sumaNR = 0;
			$sumaRep = 0;
			array_push($nuevasPlanificaciones[0],$p[1]);
			array_push($nuevasPlanificaciones[1],$p[2]);
			array_push($nuevasPlanificaciones[2],$p[3]);
			array_push($nuevasPlanificaciones[3],$p[4]);
			

		}

			$sumaTP = 0;
			$sumaTR = 0;
			$sumaTNR = 0;
			$sumaTRep = 0;


		foreach($nuevasPlanificaciones as $key=>&$p){
			$sumaP =0;
			$sumaR = 0;
			$sumaNR = 0;
			$sumaRep = 0;
			$sumas = array();

			$sumaP = $p[0][1]+$p[1][1]+$p[2][1]+$p[3][1]+$p[4][1]+$p[5][1];
			$sumaR = $p[0][2]+$p[1][2]+$p[2][2]+$p[3][2]+$p[4][2]+$p[5][2];
			$sumaNR = $p[0][3]+$p[1][3]+$p[2][3]+$p[3][3]+$p[4][3]+$p[5][3];
			$sumaRep = $p[0][4]+$p[1][4]+$p[2][4]+$p[3][4]+$p[4][4]+$p[5][4];
			$sumaTP +=$sumaP;
			$sumaTR += $sumaR;
			$sumaTNR += $sumaNR;
			$sumaTRep += $sumaRep;
			array_push($sumas,"Subtotal",$sumaR+$sumaNR+$sumaRep,$sumaR,$sumaNR,$sumaRep,round(100*$sumaR/($sumaR+$sumaNR+$sumaRep))."%" );
			$p[8] = $sumas;
			if(($p[0][2]+$p[0][3]+$p[0][4])>0)$p[0][5] = round((100*($p[0][2])/($p[0][2]+$p[0][3]+$p[0][4])), 0)."%";
			if(($p[1][2]+$p[1][3]+$p[1][4])>0)$p[1][5] = round(((100*$p[1][2])/($p[1][2]+$p[1][3]+$p[1][4])), 0)."%";
			if(($p[2][2]+$p[2][3]+$p[2][4])>0)$p[2][5] = round(((100*$p[2][2])/($p[2][2]+$p[2][3]+$p[2][4])), 0)."%";
			if(($p[3][2]+$p[3][3]+$p[3][4])>0)$p[3][5] = round(((100*$p[3][2])/($p[3][2]+$p[3][3]+$p[3][4])), 0)."%";
			if(($p[4][2]+$p[4][3]+$p[4][4])>0)$p[4][5] = round(((100*$p[4][2])/($p[4][2]+$p[4][3]+$p[4][4])), 0)."%";
			if(($p[5][2]+$p[5][3]+$p[5][4])>0)$p[5][5] = round(((100*$p[5][2])/($p[5][2]+$p[5][3]+$p[5][4])), 0)."%";

		}
			$sumas = array();
			
			array_push($sumas,"Total",$sumaTR+$sumaTNR+$sumaTRep,$sumaTR,$sumaTNR,$sumaTRep,round(100*$sumaTR/($sumaTR+$sumaTNR+$sumaTRep))."%");
			$nuevasPlanificaciones[4]=array();
			array_push($nuevasPlanificaciones[4],$sumas);
			






/////////
		
	

		$this->set("planificacionesEstadoIngenieros",$nuevasPlanificaciones);


		$this->set("filialIdeas",$filialIdeas);
		$this->set("ingFilialIdeas",$ingFilialIdeas);
		$this->set("ingFilialReportes",$filialReportes);

		
		//proyectos por ingeniero






		$proyecto = array();
		$suma1 = 0;
		$suma2 = 0;
		$suma3 = 0;
		$suma4 = 0;
		$suma5 = 0;

		foreach($ingFilial as $k=>$val){
			foreach($val as $key => $i){

				$proyectoPendiente = 0;
				$proyectoAprobado = 0;
				$proyectoRechazado =0;
				$proyectoReproceso = 0;
				if(isset($fecha)){
				$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1,'Onereport.fecha '.$fecha."'2011-06-01'")));
				$proyectoAprobado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));
				$proyectoRechazado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>3,'Onereport.fecha '.$fecha."'2011-06-01'")));
				$proyectoReproceso = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>4,'Onereport.fecha '.$fecha."'2011-06-01'")));
				$proyectoPreparacion = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>6,'Onereport.fecha '.$fecha."'2011-06-01'")));
				}
				else{
				$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1)));
				$proyectoAprobado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2)));
				$proyectoRechazado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>3)));
				$proyectoReproceso = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>4)));
				$proyectoPreparacion = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>6)));
				}
				
				$proyecto[$key] = array();
				$proyecto[$key][0] = $ingenierosNombre1[$key];
				$proyecto[$key][1] = $proyectoPendiente; //pendiente
				$proyecto[$key][2] = $proyectoPreparacion; //en evaluacion
				$proyecto[$key][3] = $proyectoAprobado; //aprobado
				$proyecto[$key][4] = $proyectoRechazado; //rechazado
				$proyecto[$key][5] = $proyectoReproceso; //rechazado
				$proyecto[$key][6] = $proyecto[$key][1]+$proyecto[$key][2]+$proyecto[$key][3]+$proyecto[$key][4]+$proyecto[$key][5];
				$suma1 += $proyecto[$key][1]; //pendientes
				$suma2 += $proyecto[$key][2]; //rechazado
				$suma3 += $proyecto[$key][3]; // en evaluacion
				$suma4 += $proyecto[$key][4]; //aprobado
				$suma5 += $proyecto[$key][5]; // en preparacion
			}
		}
		$sumas = array();
		array_push($sumas,"Total",$suma1,$suma2,$suma3,$suma4,$suma5,$suma1+$suma2+$suma3+$suma4+$suma5);
		array_push($proyecto,$sumas);
		$this->set("proyectoIngeniero",$proyecto);


	$ideasIng=array();

		foreach($ingFilial as $k=>$v){
			$ideas = array();			
			foreach($v as $kk=>$vv){
				if(isset($fecha)){
				$ideas[0] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.ideasstate_id<>'1'",'Onereport.fecha '.$fecha."'2011-06-01'")));
				$ideas[1] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.ideasstate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));
				
				}
				else{
				$ideas[0] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.ideasstate_id<>'1'")));
				$ideas[1] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.ideasstate_id"=>2)));
				
				}
				if($ideas[0] == 0){
					$ideas[3] = "0 %";
				}
				else{
				$ideas[3] = round($ideas[1]/$ideas[0],4);
				$ideas[3] = $ideas[3]*100;
				$np = explode(",",$ideas[3]);
				$ideas[3] = $np[0];
				$ideas[3] .= " %";
				
				
				}
				if(isset($fecha)){
								$ideas[4] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2,'Onereport.fecha '.$fecha."'2011-06-01'")));
				}				
				else{
								$ideas[4] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2)));
				}
				if($ideas[1] == 0){
					$ideas[5] = "0 %";
					
				}		
				else{
				$ideas[5] = round($ideas[4]/$ideas[1],4);
				$ideas[5] = $ideas[5]*100;
				$np = explode(",",$ideas[5]);
				$ideas[5] = $np[0];
				$ideas[5] .= " %";
				}
			
				$proyecto[$kk][5] = $ideas[5];
				//$ideasIng[$key][$kk] = array(0=>$this->requestAction("/engineers/getName/".$kk),1=>$ideas[0],2=>$ideas[1],3=>$ideas[3],4=>$ideas[4],5=>$ideas[5]);
				$ideasIng[$key][$kk] = array(0=>$ingenierosNombre1[$kk],1=>$ideas[0],2=>$ideas[1],3=>$ideas[3]);
			}

			
		}

		$suma1 = 0;
		$suma2 = 0;
		$i = 1;
		//Ver porque ideasing es 23 y no 6 en este caso
		foreach($ideasIng[6] as $v){
			$suma1 += $v[1];
			$suma2 += $v[2];
			$i++;
		}
		if($suma1 == 0){
			$por="0 %";
		}
		else{
		$por = round(100*$suma2/$suma1,4);
		$np = explode(',',$por);
		$por = $np[0]." %";
		}
		$total = array();
		
		array_push($total,'Total',$suma1,$suma2,$por);
		array_push($ideasIng[6],$total);

		


		$this->set("ideasIng",$ideasIng);
		
		$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id = 1 group by emsefor_id order by count(*) desc";
		$sumas = array();
		$i = 0;
		$cantEmsefor = array(102,58,26);
		foreach ($ingFilial as $k=>$v){
			$sumaEmsefor6 = 0;
			$sumaProyecto1 = 0;
			$count6 = array();
			$count2 = array();
			$porcentaje = array();
			foreach($v as $key=>$value){
				$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id =".$key." group by emsefor_id order by count(*) desc";

				$count6 = $this->Onereport->query($sql);
				foreach($count6 as $veces){

					if($veces[0]['veces'] >5){
						$sumaEmsefor6 += 1;
						
					}

				}
				$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id =".$key." and (proyectostate_id = 2 or proyectostate_id = 3 or proyectostate_id = 4) group by emsefor_id order by count(*) desc";
			
				$count2 = $this->Onereport->query($sql);
			foreach($count2 as $veces){
				if($veces[0]['veces'] > 0){
					$sumaProyecto1 += 1;
				}

			}
			
			
			}	
			$sumas[$i] = array(0=>$filiales[($i+1)],1=>$cantEmsefor[$i],2=>$sumaEmsefor6,3=>'',4=>$sumaProyecto1);
			$i++;

						

		}
				$suma1 = 0;
				$suma2 = 0;
				$i =1;
			foreach($sumas as $suma){
				//PORCENTAJE POR EMSEFOR

				$suma1 += $suma[1];
				$suma2 += $suma[2];
				$i++;
	
			}
			$sumas[0][3] = round(100*$sumas[0][2]/102,0)."%"; 
			$sumas[1][3] = round(100*$sumas[1][2]/58,0)."%";
			$sumas[2][3] = round(100*$sumas[2][2]/26,0)."%";
			$suma = array();
			array_push($suma,"Total",$suma1,$suma2,round(100*$suma2/(102+58+26),0)."%",$sumas[0][4]+$sumas[1][4]+$sumas[2][4]);

			array_push($sumas,$suma);
			$this->set('ideasProyectosPorEmsefor',$sumas);
			parent::loguea($this->data,$this->here);

		
	////////////







$engineers = array("0"=> "Seleccione ingeniero");
		$ing = 	$this->Tworeport->Engineer->find("list");	
		foreach($ing as $i){
			array_push($engineers,$i);
		}
	//	$fecha = date("Y-m-d");
		if(isset($fecha)){
			$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1 and fecha ".$fecha." '2011-06-01'  ORDER BY `Tworeport`.`semana` DESC ");
		}
		else{
			$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1  ORDER BY `Tworeport`.`semana` DESC ");
		}
		
		$reporte = array();
		foreach($tworeports as $tworeport){
			array_push($reporte,$tworeport["Tworeport"]["semana"]);
		}
		
		$tworeports = array("0"=>"Seleccione semana");
		foreach($reporte as $r){
			array_push($tworeports,$r);
		}
		
		$filials = array("0"=>"FASA (Todas)");
	
		$fil = $this->Filial->find("list",array("conditions"=>array("Filial.nombre <> 'FASA'")));
		foreach($fil as $f){
			array_push($filials,$f);
		}



		$this->set(compact('engineers','tworeports','filials'));
	
	}







	function reporte1(){
		
		$this->set("download",false);
		$engineers = array("0"=> "Seleccione ingeniero");
		$ing = 	$this->Tworeport->Engineer->find("list");	
		foreach($ing as $i){
			array_push($engineers,$i);
		}
		$fecha = date("Y-m-d");

		$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1 ORDER BY `Tworeport`.`semana` DESC ");
		$reporte = array();
		foreach($tworeports as $tworeport){
			array_push($reporte,$tworeport["Tworeport"]["semana"]);
		}
		
		$tworeports = array("0"=>"Seleccione semana");
		foreach($reporte as $r){
			array_push($tworeports,$r);
		}
		
		$filials = array("0"=>"FASA");
	
		$fil = $this->Filial->find("list",array("conditions"=>array("Filial.nombre <> 'FASA'")));
		foreach($fil as $f){
			array_push($filials,$f);
		}
		
		
		$this->set(compact('engineers','tworeports','filials'));
		if($this->data){
			
			$conditions = array();
			if($this->data["Reporte"]["tworeports"] != 0){
				$this->data["Reporte"]["tworeports"]= $tworeports[$this->data["Reporte"]["tworeports"]];
				array_push($conditions,array("Tworeport.semana" => $this->data["Reporte"]["tworeports"]));

			}
			if($this->data["Reporte"]["engineers"]!= 0){
				array_push($conditions,array("Tworeport.engineer_id" => $this->data["Reporte"]["engineers"]));
			
				
			}

			if($this->data["Reporte"]["filials"] != 0){
				$ing = $this->Tworeport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id"=>$this->data["Reporte"]["filials"])));


				$j=0;
				$c = array();				
				foreach($ing as $i=>$va){
					array_push($c,array("Tworeport.engineer_id" => $i));
					
					
				}
				$o = array("OR"=>$c);
				
				array_push($conditions,$o);
				
				
			}
			//Descomentar la siguiente linea para obtener los reportes a esta fecha!
			//array_push($conditions,"Tworeport.fecha < '".$fecha."'");
			
			
			$this->set("download", true);
			$this->Tworeport->recursive = 1;
			$this->Tworeport->order = "Tworeport.id ASC";
			$this->set('tworeports', $this->Tworeport->find("all",array("conditions" => $conditions)));
			$this->Tworeport->order = null;
			$this->set("filials",$this->Filial->find("list"));
			$this->set("nombreArchivo","reporte planificacion ");
			$this->layout = "reporte";
		
		}
	}
	function kyk(){
		
		$this->Onereport->order = "Onereport.id ASC";
		$onereport = $this->Onereport->find("all");
		$filials = $this->Filial->find("list");
		$this->set("onereport",$onereport);
		$this->set("filials",$filials);
		$this->set("nombreArchivo","reporte KyK ");
		$this->layout = "reporte";
		parent::loguea($this->data,$this->here);

	}
	function reporte1descarga(){
		$this->Onereport->order = "Onereport.id ASC";
		$onereport = $this->Onereport->find("all");
		$filials = $this->Filial->find("list");
		$positions = $this->Position->find("list");
		$unities = $this->Unity->find("list");
		$ideasstates = $this->Ideasstate->find("list");
		$cartastates = $this->Cartastate->find("list");
		$emsefors = $this->Emsefor->find("list");
		$this->set("onereport",$onereport);
		$this->set("filials",$filials);
		$this->set("positions",$positions);
		$this->set("unities",$unities);
		$this->set("ideasstates",$ideasstates);
		$this->set("cartastates",$cartastates);
		$this->set("emsefors",$emsefors);
		$this->set("nombreArchivo","reporte ideas");
		$this->layout = "reporte";
		parent::loguea($this->data,$this->here);
	}

	function reportedescarga(){
		
		$this->layout = "pdf";
		$this->render();
	}
	function resumen($descarga = null){
		
		$this->Onereport->recursive = 0;
		$onereport = $this->Onereport->find('all',array('group'=>'Onereport.emsefor_id','order'=>'Emsefor.filial_id asc','conditions'=>array('Onereport.emsefor_id>=1000')));
		$ideas = array();
		$proyectos = array();
		$emsefor = array();
		//Totales
			$total_ideas=0;
			$total_idea_aprobadas = 0;
			$total_idea_meta=0;
			$total_idea_rechazado = 0;
			$total_proyectos= 0;
			$total_proyecto_pendiente=0;
			$total_proyecto_preparacion=0;
			$total_proyecto_evaluacion=0;
			$total_proyecto_aprobado=0;
			$total_proyecto_rechazado=0;
			$total_proyecto_meta=0;
			$total_trabajadores=0;
		
		/////////
		foreach($onereport as $o){
				
				$emsefor[$o['Onereport']['emsefor_id']]=array();
				$this->Onereport->Emsefor->recursive = -1;
				$emsefor[$o['Onereport']['emsefor_id']] = $this->Onereport->Emsefor->find('all',array('conditions'=>array('Emsefor.id'=>$o['Onereport']['emsefor_id']) ) );
				$total_trabajadores += $emsefor[$o['Onereport']['emsefor_id']][0]['Emsefor']['trabajadores'];
				$ideas[$o['Onereport']['emsefor_id']]=array();
				
				$ideas[$o['Onereport']['emsefor_id']]['total'] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'])) );
				$total_ideas += $ideas[$o['Onereport']['emsefor_id']]['total'];
				
				
				$ideas[$o['Onereport']['emsefor_id']]['aprobadas'] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.ideasstate_id'=>2) ));
				$total_ideas_aprobadas=$ideas[$o['Onereport']['emsefor_id']]['aprobadas'];
				if($ideas[$o['Onereport']['emsefor_id']]['total']>=6){
					$ideas[$o['Onereport']['emsefor_id']]['meta'] = "si";
					$total_idea_meta++;
				}
				else{
					$ideas[$o['Onereport']['emsefor_id']]['meta'] = "no";
				
				}
				$ideas[$o['Onereport']['emsefor_id']]['rechazado'] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.ideasstate_id'=>3) ));
				$total_idea_rechazado+=$ideas[$o['Onereport']['emsefor_id']]['rechazado'];
				
				
			$proyectos[$o['Onereport']['emsefor_id']]=array();
				$proyectos[$o['Onereport']['emsefor_id']]['total']=$this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.proyectostate_id != 5') ));
				$total_proyectos += $proyectos[$o['Onereport']['emsefor_id']]['total'];
				
				
				$proyectos[$o['Onereport']['emsefor_id']]['pendiente']=$this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.proyectostate_id'=>'1') ));
				$total_proyecto_pendiente+=$proyectos[$o['Onereport']['emsefor_id']]['pendiente'];
				
				$proyectos[$o['Onereport']['emsefor_id']]['preparacion']=$this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.proyectostate_id'=>'6') ));
				$total_proyecto_preparacion += $proyectos[$o['Onereport']['emsefor_id']]['preparacion'];
				
				$proyectos[$o['Onereport']['emsefor_id']]['evaluacion']=$this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.proyectostate_id'=>'2') ));
				$total_proyecto_evaluacion+=$proyectos[$o['Onereport']['emsefor_id']]['evaluacion'];
				
				$proyectos[$o['Onereport']['emsefor_id']]['aprobado']=$this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.proyectostate_id'=>'3') ));				
				$total_proyecto_aprobado+=$proyectos[$o['Onereport']['emsefor_id']]['aprobado'];
				
				$proyectos[$o['Onereport']['emsefor_id']]['rechazado']=$this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$o['Onereport']['emsefor_id'],'Onereport.proyectostate_id'=>'4') ));
				$total_proyecto_rechazado += $proyectos[$o['Onereport']['emsefor_id']]['rechazado'];
				
			if($proyectos[$o['Onereport']['emsefor_id']]['total']>=1){
							$proyectos[$o['Onereport']['emsefor_id']]['meta'] = 'si';
							$total_proyecto_meta++;
			
			}
			else{
							$proyectos[$o['Onereport']['emsefor_id']]['meta'] = 'no';
			
			}
		}
		$filiales = $this->Filial->find('list');
		$this->set('filiales',$filiales);
		$this->set('onereport',$onereport);
		//hacer el array_push de los elementos totales
		/*
		    [1605] => Array
        (
            [total] => 4
            [aprobadas] => 4
            [meta] => no
            [rechazado] => 0
        )
		*/
		$sumas = array('total'=>$total_ideas,'aprobadas'=>$total_ideas_aprobadas,'meta'=>$total_idea_meta,'rechazado'=>$total_idea_rechazado);
		$this->set('total_ideas',$sumas);
		$this->set('ideas',$ideas);
		/*
		[1086] => Array
        (
            [total] => 2
            [pendiente] => 0
            [preparacion] => 0
            [evaluacion] => 0
            [aprobado] => 2
            [rechazado] => 0
            [meta] => si
        )
		*/
			$sumas = array('total'=>$total_proyectos,'pendiente'=>$total_proyecto_pendiente,'preparacion'=>$total_proyecto_preparacion,'evaluacion'=>$total_proyecto_evaluacion,'aprobado'=>$total_proyecto_aprobado,'rechazado'=>$total_proyecto_rechazado,'meta'=>$total_proyecto_meta);
			$this->set('total_proyectos',$sumas);
			$this->set('proyectos',$proyectos);
			$this->set('trabajadores',$emsefor);
			$this->set('total_trabajadores',$total_trabajadores);
				$this->set("paginacion",1);
		if($descarga == 1){
			$this->set("nombreArchivo","resumen");
			$this->set("paginacion",0);
			$this->layout = 'reporte';
	
		}
		parent::loguea($this->data,$this->here);

	}
	

		
}
?>
