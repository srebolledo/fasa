<?php
class ReportesController extends AppController {

	var $uses = array("Tworeport","Onereport","Filial","Cartastate","Ideasstate","Position","Unity","Emsefor","Engineer","Proyectostate",'Onereporthistory');
	var $helpers = array('excel');
	function index() {
		
		$this->Unity->recursive = 0;
		$this->set('unities', $this->paginate());
		parent::loguea($this->data,$this->here);
	}
	
	function reporte($etapa = null){
		$this->set('title_for_layout','Sistema de reportes | Reporte total');
		
		if($etapa != null){
			switch($etapa){
				case 2:
						$fase = 2;
						$fecha = '<';
						$this->set('title_for_layout','Sistema de reportes | Reporte fase 2');
						break;
				case 3:
						//$fase = 3;
						$fecha = '>=';
					$this->set('title_for_layout','Sistema de reportes | Reporte fase 3');
						break;
				default:
					$this->set('title_for_layout','Sistema de reportes | Reporte total');
					break;
			}
				
		}
	
		
//		$this->set('title_for_layout','Sistema de reportes | Reporte');
		if(isset($fecha)){
		$reunionesTotales  = $this->Tworeport->find("count",array('conditions'=>'Tworeport.fecha '.$fecha." '2011-06-01'"));
		} //CONDICION DE FECHA !!!!!!!!!!
		else{
		$reunionesTotales  = $this->Tworeport->find("count");
		}

		$ingenieros = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<>5")));
		$this->Engineer->recursive = -1;
		$ingenierosNombre = $this->Engineer->find("all",array("conditions"=>array("Engineer.filial_id<>5")));
		
		
		$ingenierosNombre1 = array();
		foreach($ingenierosNombre as $value){
			$ingenierosNombre1[$value['Engineer']['id']] = $value['Engineer']['nombre'];
		}

		$actividades = array(6,11,9,10);
		//planificacion, taller, grupo evaluador, GRUPO MEJORA
		$filiales = $this->Filial->find("list",array("conditions"=>array("Filial.id <= "=>3)));
		$ingFilial = array();
		//pr($filiales);
		foreach($filiales as $key=>$value){
			$ingFilial[$key] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id"=>$key)));
			
			
		}
		
		$cuentasdereporte= array();
		$sumaActividades = array();
		$sumaActividades[0] = "Totales";
		$sumaActividades[6] = 0;
		$sumaActividades[11] = 0;
		$sumaActividades[9] = 0;
		$sumaActividades[10] = 0;
		$sumaActividades[12] = 0;
		$unidadesPlanificacion = array(1,2,3,5,8,10,14,11,17,15,13,16,12);
		foreach($ingFilial as $k => $v){
			foreach($v as $key=>$value){
				$cuentasdereporte[$key][0] = $ingenierosNombre1[$key];
				$suma = 0;
				foreach ($actividades as $a){
					if(isset($fecha)){
						$cuentasdereporte[$key][$a] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$key,"Tworeport.activity_id"=>$a,"Tworeport.state_id" => 2,'Tworeport.fecha '.$fecha." '2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					}
					else{
						$cuentasdereporte[$key][$a] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$key,"Tworeport.activity_id"=>$a,"Tworeport.state_id" => 2,"Tworeport.unity_id"=>$unidadesPlanificacion)));
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
			$ideasTotales = $this->Onereport->find("count",array('conditions'=>array('Onereport.fecha '.$fecha." '2011-06-01'")));
		
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
		$ingFilialIdeas = $ingFilial;
		$ingFilialReportes = $ingFilial;

		foreach($ingFilialIdeas as $key=>&$value){
			foreach($value as $k=>&$v){
				$value[$k] = $cuentasdeideas[$k];
			}
		}
		$ingIdeas = array();
		$suma1 =0;
		$suma2=0;
		$suma3 = 0;
		$suma4=0;
		foreach($ingFilialIdeas as $key=>&$value){
			foreach($value as $k=>&$v){
				
				$total = $v[2]+$v[3];
				if($total > 0){
					$res = round(100*($v[2]/($v[2]+$v[3])),0)."%";
				}
				else{
					$res = 0;
				}
				$tmp = array($ingenierosNombre1[$k],$v[1],$v[2],$v[3],$v[4],$v[1]+$v[2]+$v[3]+$v[4],$res);
				$suma1 += $v[1];
				$suma2 += $v[2];
				$suma3 += $v[3];
				$suma4 += $v[4];
				array_push($ingIdeas,$tmp);
			}
			
		}
		//pr($ingIdeas);
		$sumas = array();
		array_push($sumas,"Total",$suma1,$suma2,$suma3,$suma4,$suma1+$suma2+$suma3+$suma4,round(100*($suma2/($suma2+$suma3)),0)."%");
		array_push($ingIdeas,$sumas);
		$this->set("ingIdeas",$ingIdeas);

		
		


		foreach($ingFilialReportes as $key=>&$value){
			foreach($value as $k=>&$v){
				//echo $k." ";
				$value[$k] = $cuentasdereporte[$k];
				///**/pr($cuentasdereporte[$k]);/**/	
			}
			
		}


		//pr($ingFilialReportes);
		
		/*** HACER DE MODO AUTOMATICO !!!! ***/
		$filialReportes=array();
		$filialReportes[0][0] = $filiales[1]; //FCEL
		$filialReportes[0][1] = $ingFilialReportes[1][2][6]+$ingFilialReportes[1][3][6]+$ingFilialReportes[1][4][6]+$ingFilialReportes[1][27][6]; //Planificacion
		$filialReportes[0][2] = $ingFilialReportes[1][2][11]+$ingFilialReportes[1][3][11]+$ingFilialReportes[1][4][11]+$ingFilialReportes[1][27][11]; //Talleres
		$filialReportes[0][3] = $ingFilialReportes[1][2][9]+$ingFilialReportes[1][3][9]+$ingFilialReportes[1][4][9]+$ingFilialReportes[1][27][9]; //Grupo Evaluador
		$filialReportes[0][4] = $ingFilialReportes[1][2][10]+$ingFilialReportes[1][3][10]+$ingFilialReportes[1][4][10]+$ingFilialReportes[1][27][10]; //Equipo de Mejora
		$filialReportes[0][5] = $filialReportes[0][1] + $filialReportes[0][2] +$filialReportes[0][3] +$filialReportes[0][4]; //Total

		$filialReportes[1][0] = $filiales[2]; //BASA
		$filialReportes[1][1] = $ingFilialReportes[2][1][6]+$ingFilialReportes[2][5][6]+$ingFilialReportes[2][28][6];
		$filialReportes[1][2] = $ingFilialReportes[2][1][11]+$ingFilialReportes[2][5][11]+$ingFilialReportes[2][28][11];
		$filialReportes[1][3] = $ingFilialReportes[2][1][9]+$ingFilialReportes[2][5][9]+$ingFilialReportes[2][28][9];
		$filialReportes[1][4] = $ingFilialReportes[2][1][10]+$ingFilialReportes[2][5][10]+$ingFilialReportes[2][28][10];
		$filialReportes[1][5] = $filialReportes[1][1] + $filialReportes[1][2] +$filialReportes[1][3] +$filialReportes[1][4];

		$filialReportes[2][0] = $filiales[3]; //FVAL
		$filialReportes[2][1] = $ingFilialReportes[3][6][6];
		$filialReportes[2][2] = $ingFilialReportes[3][6][11];
		$filialReportes[2][3] = $ingFilialReportes[3][6][9];
		$filialReportes[2][4] = $ingFilialReportes[3][6][10];
		$filialReportes[2][5] = $filialReportes[2][1] + $filialReportes[2][2] +$filialReportes[2][3] +$filialReportes[2][4];

		$filialReportes[3][0] = "Totales"; //TOTALES
		$filialReportes[3][1] = $ingFilialReportes[1][2][6]+$ingFilialReportes[1][3][6]+$ingFilialReportes[1][4][6]+$ingFilialReportes[1][27][6] + $ingFilialReportes[2][1][6]+$ingFilialReportes[2][5][6]+$ingFilialReportes[2][28][6] +$ingFilialReportes[3][6][6];
		$filialReportes[3][2] = $ingFilialReportes[1][2][11]+$ingFilialReportes[1][3][11]+$ingFilialReportes[1][4][11]+$ingFilialReportes[1][27][11]+ $ingFilialReportes[2][1][11]+$ingFilialReportes[2][5][11]+$ingFilialReportes[2][28][11] +$ingFilialReportes[3][6][11];
		$filialReportes[3][3] = $ingFilialReportes[1][2][9]+$ingFilialReportes[1][3][9]+$ingFilialReportes[1][4][9]+$ingFilialReportes[1][27][9]+$ingFilialReportes[2][1][9]+$ingFilialReportes[2][5][9]+$ingFilialReportes[2][28][9]+$ingFilialReportes[3][6][9];
		$filialReportes[3][4] = $ingFilialReportes[1][2][10]+$ingFilialReportes[1][3][10]+$ingFilialReportes[1][4][10]+$ingFilialReportes[1][27][10]+$ingFilialReportes[2][1][10]+$ingFilialReportes[2][5][10]+$ingFilialReportes[2][28][10]+$ingFilialReportes[3][6][10];
		$filialReportes[3][5] = $filialReportes[3][1] + $filialReportes[3][2] +$filialReportes[3][3] +$filialReportes[3][4];
		/*** FIN ***/
		
		//pr($filialReportes);
		
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
		
		//Begin ideas for unities
		$unities = $this->Unity->find('list',array('conditions'=>array('id!= 11','id!=9')));
		$eProyecto = array();
		$totales = array();
		$unitiesSum = array();

		foreach($ingFilial as $k=>$v){
			$unitiesSum[$k] = array();
			foreach($v as $kk=>$vv){
				if(isset($fecha)){
					$i=0;
					foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'")));	
					else $unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'")));				
				}
			}
			else{
				foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))	$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity)));						
					else{
							$unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity)));						
						}
					}				
				}
			}
		}
		$unitiesSum[1][0] = 'FCEL';
		$unitiesSum[2][0] = 'BASA';
		$unitiesSum[3][0] = 'FVAL';		
		//$unitiesSum[1][11] = $unitiesSum[1][7]+$unitiesSum[1][12]+$unitiesSum[1][13]+$unitiesSum[1][14]+$unitiesSum[1][15]+$unitiesSum[1][16]; 
		//$unitiesSum[2][11] = $unitiesSum[2][7]+$unitiesSum[2][12]+$unitiesSum[2][13]+$unitiesSum[2][14]+$unitiesSum[2][15]+$unitiesSum[2][16]; 
		//$unitiesSum[3][11] = $unitiesSum[3][7]+$unitiesSum[3][12]+$unitiesSum[3][13]+$unitiesSum[3][14]+$unitiesSum[3][15]+$unitiesSum[3][16]; 
		//$unitiesSum[1][18] = $unitiesSum[1][17]+$unitiesSum[1][10];
		//$unitiesSum[2][18] = $unitiesSum[2][17]+$unitiesSum[2][10];
		//$unitiesSum[3][18] = $unitiesSum[3][17]+$unitiesSum[3][10];
		$this->set("ideasFilialUnidadGrafico",$unitiesSum);
		$this->set('unities',$unities);
		
		//end ideas for unities



//Begin project for unities
		$unities = $this->Unity->find('list');
		$eProyecto = array();
		$totales = array();
		$unitiesSum = array();

		foreach($ingFilial as $k=>$v){
			$unitiesSum[$k] = array();
			foreach($v as $kk=>$vv){
				if(isset($fecha)){
					$i=0;
					foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'",'Onereport.ideasstate_id'=>2)));	
					else $unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'",'Onereport.ideasstate_id'=>2)));					
				}
			}
			else{
				foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))	$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.ideasstate_id'=>2)));						
					else{
							$unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity)));						
						}
					}				
				}
			}
		}
		$unitiesSum[1][0] = 'FCEL';
		$unitiesSum[2][0] = 'BASA';
		$unitiesSum[3][0] = 'FVAL';		
		$unitiesSum[1][11] = $unitiesSum[1][7]+$unitiesSum[1][12]+$unitiesSum[1][13]+$unitiesSum[1][14]+$unitiesSum[1][15]+$unitiesSum[1][16]; 
		$unitiesSum[2][11] = $unitiesSum[2][7]+$unitiesSum[2][12]+$unitiesSum[2][13]+$unitiesSum[2][14]+$unitiesSum[2][15]+$unitiesSum[2][16]; 
		$unitiesSum[3][11] = $unitiesSum[3][7]+$unitiesSum[3][12]+$unitiesSum[3][13]+$unitiesSum[3][14]+$unitiesSum[3][15]+$unitiesSum[3][16]; 
		$unitiesSum[1][18] = $unitiesSum[1][17]+$unitiesSum[1][10];
		$unitiesSum[2][18] = $unitiesSum[2][17]+$unitiesSum[2][10];
		$unitiesSum[3][18] = $unitiesSum[3][17]+$unitiesSum[3][10];
		$this->set("proyectosFilialUnidadGrafico",$unitiesSum);		
		//end projects for unities





/////// Reporte de realizadas no realizadas replanificadas por ingeniero en taller,planificacion, grupo de {mejora,evaluador}
	$i=1;
	$j=1;
	foreach($ingFilial as $k => $v){
		foreach($v as $key=>$val){
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Talleres"; 
				if(isset($fecha)){
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Planificación";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));	

				$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo Evaluador";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));	


					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo de Mejora";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));	
				$i=1;
				$j=1;

				}
				
				else{
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Planificación";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>array(2,3,4),"Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion)));	

				$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo Evaluador";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>array(2,3,4),"Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion)));	


					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo de Mejora";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion)));	
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

   //Cambiar este codigo para hacerlo dinamico. Dentro de los $P esta el arreglo de ingenieros, solo sirve para el los ingenieros definidos, si se agrega uno nuevo, se debe modifiar codigo.
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
			$porcentaje = $sumaR+$sumaNR+$sumaRep;
			if($porcentaje == 0){
				$porcentaje =0;
			}
			else{
				$porcentaje = round(100*$sumaR/($sumaR+$sumaNR+$sumaRep));
			}
			
			array_push($sumas,"Subtotal",$sumaR+$sumaNR+$sumaRep,$sumaR,$sumaNR,$sumaRep,$porcentaje."%" );
			$p[8] = $sumas;
			if(($p[0][2]+$p[0][3]+$p[0][4])>0)$p[0][5] = round((100*($p[0][2])/($p[0][2]+$p[0][3]+$p[0][4])), 0)."%";
			else{
				$p[0][5] = "0%";
				
			}
			if(($p[1][2]+$p[1][3]+$p[1][4])>0)$p[1][5] = round(((100*$p[1][2])/($p[1][2]+$p[1][3]+$p[1][4])), 0)."%";
			else{
				$p[1][5] = "0%";
				
			}
			if(($p[2][2]+$p[2][3]+$p[2][4])>0)$p[2][5] = round(((100*$p[2][2])/($p[2][2]+$p[2][3]+$p[2][4])), 0)."%";
			else{
				$p[2][5] = "0%";
				
			}
			if(($p[3][2]+$p[3][3]+$p[3][4])>0)$p[3][5] = round(((100*$p[3][2])/($p[3][2]+$p[3][3]+$p[3][4])), 0)."%";
			else{
				$p[3][5] = "0%";
				
			}
			if(($p[4][2]+$p[4][3]+$p[4][4])>0)$p[4][5] = round(((100*$p[4][2])/($p[4][2]+$p[4][3]+$p[4][4])), 0)."%";
			else{
				$p[4][5] = "0%";
				
			}
			if(($p[5][2]+$p[5][3]+$p[5][4])>0)$p[5][5] = round(((100*$p[5][2])/($p[5][2]+$p[5][3]+$p[5][4])), 0)."%";
			else{
				$p[5][5] = "0%";
				
			}
			if(($p[6][2]+$p[6][3]+$p[6][4])>0)$p[6][5] = round(((100*$p[6][2])/($p[6][2]+$p[6][3]+$p[6][4])), 0)."%";
			else{
				$p[6][5] = "0%";
				
			}
			if(($p[7][2]+$p[7][3]+$p[7][4])>0)$p[7][5] = round(((100*$p[7][2])/($p[7][2]+$p[7][3]+$p[7][4])), 0)."%";
			else{
				$p[7][5] = "0%";
				
			}

			
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
				/*Haciendo arreglos, solo para proyectos != de estados pendiente y aprobados*/
//				$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1,'Onereport.fecha '.$fecha."'2011-06-01'")));
 					$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoAprobado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoRechazado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>3,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoReproceso = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>4,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoPreparacion = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>6,"Onereport.fecha ".$fecha." '2011-06-01'")));
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


	/*$ideasIng=array();

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
		//Ver porque ideas ing es 23 y no 6 en este caso	
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
*/		
		$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id = 1 group by emsefor_id order by count(*) desc";
		$sumas = array();
		$i = 0;
		$cantEmsefor = array(129,92,40);
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

					if($veces[0]['veces'] >0){
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
			$sumas[$i] = array(0=>$filiales[($i+1)],1=>$cantEmsefor[$i],2=>$sumaEmsefor6,3=>'',4=>$sumaProyecto1,5=>round(100*$sumaProyecto1/$cantEmsefor[$i])."%");
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
			$sumas[0][3] = round(100*$sumas[0][2]/$cantEmsefor[0],0)."%"; 
			$sumas[1][3] = round(100*$sumas[1][2]/$cantEmsefor[1],0)."%";
			$sumas[2][3] = round(100*$sumas[2][2]/$cantEmsefor[2],0)."%";

			$suma = array();
			array_push($suma,"Total",$suma1,$suma2,round(100*$suma2/($cantEmsefor[0]+$cantEmsefor[1]+$cantEmsefor[2]),0)."%",$sumas[0][4]+$sumas[1][4]+$sumas[2][4],round(100*($sumas[0][4]+$sumas[1][4]+$sumas[2][4])/$suma1)."%");

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
		if(isset($fecha)){
			$this->set('ideasEmsefor',$this->_ideasEmsefor($fecha));
			$this->set('projectsEmsefor',$this->_projectsEmsefor($fecha));

			$this->set('planificationUnities',$this->_planificationUnities(true,$fecha));
			$this->set('ideasUnities',$this->_ideasUnities(true,$fecha));
			$this->set('projectsUnities',$this->_projectsUnities(true,$fecha));
			$this->set('trabajadores',$this->_getWorkersTable());

		}
		else{
			$this->set('ideasEmsefor',$this->_ideasEmsefor());
			$this->set('projectsEmsefor',$this->_projectsEmsefor());

			
			$this->set('planificationUnities',$this->_planificationUnities());
			$this->set('ideasUnities',$this->_ideasUnities());
			$this->set('projectsUnities',$this->_projectsUnities());
		}
		
		
	}
		
	function _planificationUnities($fase = false,$fecha = null,$fecha2 = null){
		if($fase == null && $fecha != null && $fecha2 != null){
			$start = $fecha;
			$end = $fecha2;
		
		}
		$unities = $this->Unity->find('list',array('condtions'=>array('Unity.id'=>array(1,2,3,5,8,10,14,11,17,15,13,16,12))));
		$activities = array(6,11,9,10);
		$reporte = array();
		$engineers = $this->Engineer->find('all',array('conditions'=>array('filial_id<4')));
		$filialEngineer = array();
		$filialEngineer[1] = array();
		$filialEngineer[2] = array();
		$filialEngineer[3] = array();
		foreach($engineers as $key=>$value){
			if($value['Engineer']['filial_id'] == 1){
				array_push($filialEngineer[1],$value['Engineer']['id']);
			}
			else if($value['Engineer']['filial_id'] == 2){
				array_push($filialEngineer[2],$value['Engineer']['id']);
			}
			else if($value['Engineer']['filial_id'] == 3){
				array_push($filialEngineer[3],$value['Engineer']['id']);
			}
		}
		//pr($filialEngineer);  //Verificar si se tomaron todos los ingenieros //OK, funciona
		
		$tmp = array();
		
		foreach($filialEngineer as $keyFilial=>$value):
			foreach($unities as $keyU => $unity){
			$suma=0;
				foreach($activities as $activity){
					if($fase){
						$reporte[$keyFilial][$keyU][0] = $unity;
						$reporte[$keyFilial][$keyU][$activity] = $this->Tworeport->find('count',array('conditions'=>array('Tworeport.unity_id'=>$keyU,"Tworeport.state_id" => 2,'Tworeport.activity_id'=>$activity,"Tworeport.fecha ".$fecha." '2011-06-01'","Tworeport.engineer_id"=>$value)));
						$suma += $reporte[$keyFilial][$keyU][$activity];
					}
					else{
						
						$reporte[$keyFilial][$keyU][0] = $unity;
						if($start && $end){
							$reporte[$keyFilial][$keyU][$activity] = $this->Tworeport->find('count',array('conditions'=>array('Tworeport.unity_id'=>$keyU,"Tworeport.state_id" => 2,'Tworeport.activity_id'=>$activity,"Tworeport.engineer_id"=>$value,"Tworeport.fecha >=" => $start,"Tworeport.fecha <="=>$end)));
						}
						else{
							$reporte[$keyFilial][$keyU][$activity] = $this->Tworeport->find('count',array('conditions'=>array('Tworeport.unity_id'=>$keyU,"Tworeport.state_id" => 2,'Tworeport.activity_id'=>$activity,"Tworeport.engineer_id"=>$value)));
						}
						$suma += $reporte[$keyFilial][$keyU][$activity];
					}		
				}
			$reporte[$keyFilial][$keyU][1000] = $suma;
		}
		endforeach;
		
		$reportes = $reporte;
		unset($reporte);
		$tmp = array();
		foreach($reportes as $reporte):
		$tmp1 = array(1=>$reporte[1],$reporte[2],$reporte[3],$reporte[5],$reporte[8],$reporte[10],$reporte[14],$reporte[11],$reporte[17],$reporte[15],$reporte[13],$reporte[16],$reporte[12]);
		$reporte = $tmp1;
		$nReporte = array();
		$i =0;
		$sumasMantencion = array(0=>'Subtotal de mantención',6=>0,11=>0,9=>0,10=>0,1000=>0);
		$sumasExpansion = array(0=>'Subtotal de expansión',6=>0,11=>0,9=>0,10=>0,1000=>0	);
		foreach($reporte as $report){

			if($i<5){
				//mantencion
				$sumasMantencion[6]=$sumasMantencion[6]+$report[6];
				$sumasMantencion[11]=$sumasMantencion[11]+$report[11];
				$sumasMantencion[9]=$sumasMantencion[9]+$report[9];
				$sumasMantencion[10]=$sumasMantencion[10]+$report[10];
				$sumasMantencion[1000] = $sumasMantencion[1000]+$report[1000];
			}
			
			
			else{
				//expansion
				$sumasExpansion[6]=$sumasExpansion[6]+$report[6];
				$sumasExpansion[11]=$sumasExpansion[11]+$report[11];
				$sumasExpansion[9]=$sumasExpansion[9]+$report[9];
				$sumasExpansion[10]=$sumasExpansion[10]+$report[10];
				$sumasExpansion[1000] = $sumasExpansion[1000]+$report[1000];

			}
			$nReporte[] = $report;
			$i++;
			
			
		}
		
		
		$reporte = $nReporte;
		unset($nReporte);
		for($i=0;$i<5;$i++){
			if(array_key_exists($i,$reporte))$nReporte[] = $reporte[$i];
		}
		$nReporte[] = $sumasMantencion;
		for($i=5;$i<16;$i++){
			if(array_key_exists($i,$reporte))$nReporte[] = $reporte[$i];
		}
		$nReporte[] = $sumasExpansion;
		$tmp[] = $nReporte;
		endforeach;
		$reporte = array(1=>$tmp[0],2=>$tmp[1],3=>$tmp[2]);
		
		return $reporte;
	
	}
	
	function _ideasUnities($fase = false,$fecha = null,$fecha2){
		if($fase == null && $fecha != null && $fecha2 != null){
			$start = $fecha;
			$end = $fecha2;
		
		}
		$unities = $this->Unity->find('list',array('condtions'=>array('Unity.id'=>array(1,2,3,5,8,10,14,11,17,15,13,16,12))));
		$ideasstates = $this->Ideasstate->find('list',array('conditions'=>array('id'=>array(1,2,3,4))));
		$ideas = array();
		
		$engineers = $this->Engineer->find('all',array('conditions'=>array('filial_id<4')));
		$filialEngineer = array();
		$filialEngineer[1] = array();
		$filialEngineer[2] = array();
		$filialEngineer[3] = array();
		foreach($engineers as $key=>$value){
			if($value['Engineer']['filial_id'] == 1){
				array_push($filialEngineer[1],$value['Engineer']['id']);
			}
			else if($value['Engineer']['filial_id'] == 2){
				array_push($filialEngineer[2],$value['Engineer']['id']);
			}
			else if($value['Engineer']['filial_id'] == 3){
				array_push($filialEngineer[3],$value['Engineer']['id']);
			}
		}
		foreach($filialEngineer as $keyFilial=>$value):
			foreach($unities as $keyU=>$unity){
				$suma=0;
				foreach($ideasstates as $keyI => $ideasstate){
					if($fase && $fecha2 == null){
						$ideas[$keyFilial][$keyU][0] = $unity;
						$ideas[$keyFilial][$keyU][$keyI] = $this->Onereport->find('count',array('conditions'=>array('Onereport.unity_id'=>$keyU,'Onereport.ideasstate_id'=>$keyI,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.engineer_id'=>$value)));
						$suma += $ideas[$keyFilial][$keyU][$keyI];
					}
					else{
						$ideas[$keyFilial][$keyU][0] = $unity;
						if($start && $end){
							$ideas[$keyFilial][$keyU][$keyI] = $this->Onereport->find('count',array('conditions'=>array('Onereport.unity_id'=>$keyU,'Onereport.ideasstate_id'=>$keyI,'Onereport.engineer_id'=>$value,"Onereport.fecha >=" => $start,"Onereport.fecha <="=>$end)));
						}
						else{
							$ideas[$keyFilial][$keyU][$keyI] = $this->Onereport->find('count',array('conditions'=>array('Onereport.unity_id'=>$keyU,'Onereport.ideasstate_id'=>$keyI,'Onereport.engineer_id'=>$value)));
						}
						$suma +=$ideas[$keyFilial][$keyU][$keyI];
					}
				}
				$ideas[$keyFilial][$keyU][1000] = $suma;
		}
		endforeach;
		$tmp = array();
		foreach($ideas as $idea){
			$nReporte = array();
			$i =0;
			$tmp1 = array(1=>$idea[1],$idea[2],$idea[3],$idea[5],$idea[8],$idea[10],$idea[14],$idea[11],$idea[17],$idea[15],$idea[13],$idea[16],$idea[12]);
			$idea = $tmp1;
			$sumasMantencion = array(0=>'Subtotal de mantención',0,0,0,0,1000=>0);
			$sumasExpansion = array(0=>'Subtotal de expansión',0,0,0,0,1000=>0	);
			foreach($idea as $report){
				if($i<5){
					//mantencion
					$sumasMantencion[1]=$sumasMantencion[1]+$report[1];
					$sumasMantencion[2]=$sumasMantencion[2]+$report[2];
					$sumasMantencion[3]=$sumasMantencion[3]+$report[3];
					$sumasMantencion[4]=$sumasMantencion[4]+$report[4];
					$sumasMantencion[1000] = $sumasMantencion[1000]+$report[1000];
				}
				
				
				else{
					//expansion
					$sumasExpansion[1]=$sumasExpansion[1]+$report[1];
					$sumasExpansion[2]=$sumasExpansion[2]+$report[2];
					$sumasExpansion[3]=$sumasExpansion[3]+$report[3];
					$sumasExpansion[4]=$sumasExpansion[4]+$report[4];
					$sumasExpansion[1000] = $sumasExpansion[1000]+$report[1000];
	
				}
				$nReporte[] = $report;
				$i++;
			}
			
			
			$reporte = $nReporte;
			unset($nReporte);
			for($i=0;$i<5;$i++){
				if(array_key_exists($i,$reporte)) $nReporte[] = $reporte[$i];
			}
			$nReporte[] = $sumasMantencion;
			for($i=5;$i<16;$i++){
				if(array_key_exists($i,$reporte)) $nReporte[] = $reporte[$i];
			}
			$nReporte[] = $sumasExpansion;
			$reporte = $nReporte;
			$tmp[] = $reporte;
			}
			
			$ideas = array(1=>$tmp[0],2=>$tmp[1],3=>$tmp[2]);	
				
		return $ideas;
	}
	
	
	function _projectsUnities($fase = false,$fecha = null,$fecha2 = null){
		if($fase == null && $fecha != null && $fecha2 != null){
			$start = $fecha;
			$end = $fecha2;
		
		}
		$unities = $this->Unity->find('list');
		$this->loadModel('Proyectostate');
		//$projectstates = $this->Proyectostate->find('list',array('conditions'=>array('id'=>array(1,6,2,3,4))));
		$projectstates = array(1=>"Pendiente",6=>"En preparación",2=>'En revisión',3=>'Aprobados',4=>'Rechazados');
		$projects = array();
		$engineers = $this->Engineer->find('all',array('conditions'=>array('filial_id<4')));
		$filialEngineer = array();
		$filialEngineer[1] = array();
		$filialEngineer[2] = array();
		$filialEngineer[3] = array();
		
		foreach($engineers as $key=>$value){
			if($value['Engineer']['filial_id'] == 1){
				array_push($filialEngineer[1],$value['Engineer']['id']);
			}
			else if($value['Engineer']['filial_id'] == 2){
				array_push($filialEngineer[2],$value['Engineer']['id']);
			}
			else if($value['Engineer']['filial_id'] == 3){
				array_push($filialEngineer[3],$value['Engineer']['id']);
			}
		}
		foreach($filialEngineer as $keyFilial=>$value):
		foreach($unities as $keyU=>$unity){
			$suma=0;
			foreach($projectstates as $keyP => $projectstate){
				if($fase && $fecha2 == null){
					$projects[$keyFilial][$keyU][0] = $unity;
					$projects[$keyFilial][$keyU][$keyP] = $this->Onereport->find('count',array('conditions'=>array('Onereport.unity_id'=>$keyU,'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>$keyP,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.engineer_id'=>$value)));
					$suma += $projects[$keyFilial][$keyU][$keyP];
				}
				else{
					$projects[$keyFilial][$keyU][0] = $unity;
					if($start && $end){
						$projects[$keyFilial][$keyU][$keyP] = $this->Onereport->find('count',array('conditions'=>array('Onereport.unity_id'=>$keyU,'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>$keyP,'Onereport.engineer_id'=>$value,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
					}
					else{
						$projects[$keyFilial][$keyU][$keyP] = $this->Onereport->find('count',array('conditions'=>array('Onereport.unity_id'=>$keyU,'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>$keyP,'Onereport.engineer_id'=>$value)));
					}
					
					$suma +=$projects[$keyFilial][$keyU][$keyP];
				}
			}
			$projects[$keyFilial][$keyU][1000] = $suma;
		}
	
		endforeach;
		$tmp = array();
		foreach($projects as $idea){
		$tmp1 = array(1=>$idea[1],$idea[2],$idea[3],$idea[5],$idea[8],$idea[10],$idea[14],$idea[11],$idea[17],$idea[15],$idea[13],$idea[16],$idea[12]);
		$idea = $tmp1;

			$nReporte = array();
			$i =0;
			$sumasMantencion = array(0=>'Subtotal de mantención',1=>0,2=>0,3=>0,4=>0,6=>0,1000=>0);
			$sumasExpansion = array(0=>'Subtotal de expansión',1=>0,2=>0,3=>0,4=>0,6=>0,1000=>0	);
			foreach($idea as $report){
				if($i<5){
					//mantencion
					$sumasMantencion[1]=$sumasMantencion[1]+$report[1];
					$sumasMantencion[3]=$sumasMantencion[3]+$report[2];
					$sumasMantencion[4]=$sumasMantencion[4]+$report[3];
					$sumasMantencion[6]=$sumasMantencion[6]+$report[4];
					$sumasMantencion[2]=$sumasMantencion[2]+$report[6];
					$sumasMantencion[1000] = $sumasMantencion[1000]+$report[1000];
				}
				
				
				else{
					//expansion
					$sumasExpansion[1]=$sumasExpansion[1]+$report[1];
					$sumasExpansion[3]=$sumasExpansion[3]+$report[2];
					$sumasExpansion[4]=$sumasExpansion[4]+$report[3];
					$sumasExpansion[6]=$sumasExpansion[6]+$report[4];
					$sumasExpansion[2]=$sumasExpansion[2]+$report[6];
					$sumasExpansion[1000] = $sumasExpansion[1000]+$report[1000];
	
				}
				$nReporte[] = $report;
				$i++;
			}
			
			
			$reporte = $nReporte;
			unset($nReporte);
			for($i=0;$i<5;$i++){
				if(array_key_exists($i,$reporte)) $nReporte[] = $reporte[$i];
			}
			$nReporte[] = $sumasMantencion;
			for($i=5;$i<16;$i++){
				if(array_key_exists($i,$reporte)) $nReporte[] = $reporte[$i];
			}
			$nReporte[] = $sumasExpansion;
			$reporte = $nReporte;
			$tmp[] = $reporte;	
			}
			
			$projects = array(1=>$tmp[0],2=>$tmp[1],3=>$tmp[2]);	
		return $projects;
	
	}


	function _ideasEmsefor($fecha = null,$fecha2 = null){
		if($fecha!= null && $fecha2 != null){
			$start = $fecha;
			$end = $fecha2;
		
		}
		$this->Emsefor->recursive = 0;
		if($fecha && $fecha2 == null){
			$emsefors = $this->Onereport->find('all',array('conditions'=>array('Onereport.emsefor_id >= 1000','Onereport.fecha '.$fecha." '2011-06-01'"),'group'=>'Onereport.emsefor_id'));
		}
		else{
			$emsefors = $this->Onereport->find('all',array('conditions'=>array('Onereport.emsefor_id >= 1000','Onereport.fecha >='=>$start,"Onereport.fecha <="=>$end),'group'=>'Onereport.emsefor_id'));
		}		
		$cuentas = array();
		$cuentas[1] = array();
		$cuentas[2] = array();
		$cuentas[3] = array();
		$sumas = array();
		$sumas[1][0] = 'Total';
		$sumas[1][1] = '';
		$sumas[1][2] = 0;
		$sumas[1][3] = 0;
		$sumas[1][4] = 0;
		$sumas[1][5] = 0;
		$sumas[1][6] = 0;
		$sumas[2][0] = 'Total';
		$sumas[2][1] = '';
		$sumas[2][2] = 0;
		$sumas[2][3] = 0;
		$sumas[2][4] = 0;
		$sumas[2][5] = 0;
		$sumas[2][6] = 0;
		$sumas[3][0] = 'Total';
		$sumas[3][1] = '';
		$sumas[3][2] = 0;
		$sumas[3][3] = 0;
		$sumas[3][4] = 0;
		$sumas[3][5] = 0;
		$sumas[3][6] = 0;

				
		foreach($emsefors as $key=>$value){
			if($fecha && $fecha2 == null){
				//$cuentas[$value['Emsefor']['id']] = array();
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][0] = $value['Emsefor']['nombre'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][1] = $value['Emsefor']['lugar'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>1,"Onereport.fecha ".$fecha." '2011-06-01'")));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha ".$fecha." '2011-06-01'")));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>3,"Onereport.fecha ".$fecha." '2011-06-01'")));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>4,"Onereport.fecha ".$fecha." '2011-06-01'")));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6] = $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4];
				$sumas[$value['Emsefor']['filial_id']][2] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2];
				$sumas[$value['Emsefor']['filial_id']][3] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3];
				$sumas[$value['Emsefor']['filial_id']][4] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4];
				$sumas[$value['Emsefor']['filial_id']][5] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5];
				$sumas[$value['Emsefor']['filial_id']][6] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6];
				
			}
			else{
				//$cuentas[$value['Emsefor']['id']] = array();
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][0] = $value['Emsefor']['nombre'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][1] = $value['Emsefor']['lugar'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>1,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>3,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>4,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6] = $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4];
				$sumas[$value['Emsefor']['filial_id']][2] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2];
				$sumas[$value['Emsefor']['filial_id']][3] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3];
				$sumas[$value['Emsefor']['filial_id']][4] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4];
				$sumas[$value['Emsefor']['filial_id']][5] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5];
				$sumas[$value['Emsefor']['filial_id']][6] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6];
			}		
		}
		array_push($cuentas[1],$sumas[1]);
		array_push($cuentas[2],$sumas[2]);
		array_push($cuentas[3],$sumas[3]);
		return $cuentas;
	
	
	}
	
	function _projectsEmsefor($fecha = null, $fecha2 = null){
		if($fecha != null && $fecha2 != null){
			$start = $fecha;
			$end = $fecha2;
		
		}
		$this->Onereport->recursive = 0;
		if($fecha && $fecha2 == null){
			$emsefors = $this->Onereport->find('all',array('conditions'=>array('Onereport.emsefor_id >= 1000','Onereport.fecha'.$fecha."'2011-06-01'",'Onereport.ideasstate_id'=>2),'group'=>'Onereport.emsefor_id'));
		}
		else{
			$emsefors = $this->Onereport->find('all',array('conditions'=>array('Onereport.emsefor_id >= 1000','Onereport.ideasstate_id'=>2,'Onereport.fecha =>' => $start,'Onereport.fecha <=' => $end),'group'=>'Onereport.emsefor_id'));
		}


		$cuentas = array();
		$cuentas[1] = array();
		$cuentas[2] = array();
		$cuentas[3] = array();
		$sumas = array();
		$sumas[1][0] = 'Total';
		$sumas[1][1] = '';
		$sumas[1][2] = 0;
		$sumas[1][3] = 0;
		$sumas[1][4] = 0;
		$sumas[1][5] = 0;
		$sumas[1][6] = 0;
		$sumas[1][7] = 0;
		$sumas[2][0] = 'Total';
		$sumas[2][1] = '';
		$sumas[2][2] = 0;
		$sumas[2][3] = 0;
		$sumas[2][4] = 0;
		$sumas[2][5] = 0;
		$sumas[2][6] = 0;
		$sumas[2][7] = 0;
		$sumas[3][0] = 'Total';
		$sumas[3][1] = '';
		$sumas[3][2] = 0;
		$sumas[3][3] = 0;
		$sumas[3][4] = 0;
		$sumas[3][5] = 0;
		$sumas[3][6] = 0;
		$sumas[3][7] = 0;

				
		foreach($emsefors as $key=>$value){
			if($fecha && $fecha2 == null){
				//$cuentas[$value['Filial']['id']] = array();
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][0] = $value['Emsefor']['nombre'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][1] = $value['Emsefor']['lugar'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.proyectostate_id'=>1)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.proyectostate_id'=>6)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.proyectostate_id'=>2)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.proyectostate_id'=>3)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,"Onereport.fecha ".$fecha." '2011-06-01'",'Onereport.proyectostate_id'=>4)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][7] = $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6];
				$sumas[$value['Emsefor']['filial_id']][2] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2];
				$sumas[$value['Emsefor']['filial_id']][3] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3];
				$sumas[$value['Emsefor']['filial_id']][4] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4];
				$sumas[$value['Emsefor']['filial_id']][5] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5];
				$sumas[$value['Emsefor']['filial_id']][6] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6];
				$sumas[$value['Emsefor']['filial_id']][7] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][7];
				
			}
			else{
				//$cuentas[$value['Filial']['id']] = array(); 1,6,2,3,4
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][0] = $value['Emsefor']['nombre'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][1] = $value['Emsefor']['lugar'];
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>1,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>6,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>2,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>3,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6] = $this->Onereport->find('count',array('conditions'=>array('Onereport.emsefor_id'=>$value['Emsefor']['id'],'Onereport.ideasstate_id'=>2,'Onereport.proyectostate_id'=>4,"Onereport.fecha =>"=>$start,"Onereport.fecha <="=>$end)));
				$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][7] = $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4]+$cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5];
				$sumas[$value['Emsefor']['filial_id']][2] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][2];
				$sumas[$value['Emsefor']['filial_id']][3] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][3];
				$sumas[$value['Emsefor']['filial_id']][4] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][4];
				$sumas[$value['Emsefor']['filial_id']][5] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][5];
				$sumas[$value['Emsefor']['filial_id']][6] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][6];
				$sumas[$value['Emsefor']['filial_id']][7] += $cuentas[$value['Emsefor']['filial_id']][$value['Emsefor']['id']][7];
			}		
		}
		array_push($cuentas[1],$sumas[1]);
		array_push($cuentas[2],$sumas[2]);
		array_push($cuentas[3],$sumas[3]);
		return $cuentas;
	
	
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
	

	function reportedescarga($reporte = null){
		App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
		App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel5.php'));
		$xls = new PHPExcel();
		$this->set('xls',$xls);
		$conditions = array();
		$filials = $this->Filial->find('list');
		$this->set('filials',$filials);
		if($reporte==1){
				$this->Onereport->order = 'Onereport.id desc';
				$usuario = $this->Session->read('Auth.User');
				if($usuario['group_id'] == 1 || $usuario['group_id']==3){
					$conditions = array();
					$this->set('ingenieros',true);
				
				}
				else if($usuario['group_id'] == 2){
					$conditions = array('Engineer.user_id'=>$usuario['id']);
					$this->set('ingenieros',false);
				}
				else if($usuario['group_id'] == 4){
					$ing = $this->Engineer->find('all',array('conditions'=>array('Engineer.user_id'=>$usuario['id'])));
					$filial = $ing[0]['Engineer']['filial_id']-5;
					$this->Engineer->recursive = -1;
					$ing = $this->Engineer->find('all',array('conditions'=>array('Engineer.filial_id'=>$filial)));
					$engineers = array();
					foreach($ing as $key=>$value){
						array_push($engineers,$value['Engineer']['id']);
					}
					$conditions = array('Engineer.id'=>$engineers);
					$this->set('ingenieros',true);
				}
				//$conditions['Onereport.fecha > \'2011-06-01\''] = '';
				
				/*$onereports = $this->Onereport->find('all',array('conditions'=>array('Onereport.engineer_id'=>$conditions,'Onereport.fecha > \'2011-06-01\'')));*/
				$onereports = $this->Onereport->find('all',array('conditions'=>array($conditions)));
				$this->set('onereports',$onereports);
				$this->set('reporte',1);
				$this->set("nombreArchivo","Reporte de ideas a dia ");
				$this->layout = "ajax";
		
		}
		if($reporte == 2){
				$this->Tworeport->order = 'Tworeport.id desc';
				$usuario = $this->Session->read('Auth.User');
				if($usuario['group_id'] == 1 || $usuario['group_id']==3){
					$conditions == array();
					$this->set('ingenieros',true);
				
				}
				else if($usuario['group_id'] == 2){
					$conditions = array('Engineer.user_id'=>$usuario['id']);
					$this->set('ingenieros',false);
				}
				else if($usuario['group_id'] == 4){
					$ing = $this->Engineer->find('all',array('conditions'=>array('Engineer.user_id'=>$usuario['id'])));
					$filial = $ing[0]['Engineer']['filial_id']-5;
					$this->Engineer->recursive = -1;
					$ing = $this->Engineer->find('all',array('conditions'=>array('Engineer.filial_id'=>$filial)));
					$engineers = array();
					foreach($ing as $key=>$value){
						array_push($engineers,$value['Engineer']['id']);
					}
					$conditions = array('Engineer.id'=>$engineers);
					$this->set('ingenieros',true);
				}
				//$conditions['Tworeport.fecha > \'2011-06-01\''] = '';
				$this->Engineer->recursive = -1;
				$tworeports = $this->Tworeport->find('all',array('conditions'=>$conditions));
				$this->set('tworeports',$tworeports);
				$this->set('reporte',2);
				$this->set("nombreArchivo","Reportes de planificación a dia ");
				$this->layout = "ajax";
				
		}	
		else{
				$this->referer();
		}
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
	
	function _getWorkersTable(){
		$this->Tworeport->recursive = -1;
		$tworeports = $this->Tworeport->find('all',array('DISTINCT Tworeport.emsefor_id','order'=>'emsefor_id DESC','group'=>'emsefor_id'));
		$emsefors = array();
		foreach($tworeports as $tworeport){
			$emsefors[] = $tworeport['Tworeport']['emsefor_id'];
		
		}
		unset($tworeports);
		$filials = array();
		$filials[1] = 0;
		$filials[2] = 0;
		$filials[3] = 0;
		foreach($emsefors as $emsefor){
			$this->Tworeport->recursive = -1;
			$tworeports = $this->Tworeport->find('all',array('conditions'=>array('emsefor_id'=>$emsefor,"fecha >= '2011-06-01'")));
			foreach($tworeports as $tworeport){
				$filials[$this->_getFilialEngineer($tworeport['Tworeport']['engineer_id'])] += $tworeport['Tworeport']['participantes_reales'];
			}
		
		}
		/*
			   FCEL   23 emsefor;   1.670  trab.
              -BASA  34 emsefor    1.182 trab.
              -FVAL   14 emsefor       376 trab.

		*/
		$table[] = array('FCEL',1670,$filials[1],100*round($filials[1]/1670,2)."%");
		$table[] = array('BASA',1182,$filials[2],100*round($filials[2]/1182,2)."%");
		$table[] = array('FVAL',376,$filials[3],100*round($filials[3]/376,2)."%");
		
		$table[] = array('Total',1670+1182+376,$filials[1]+$filials[2]+$filials[3],100*round(($filials[1]+$filials[2]+$filials[3])/(1670+1182+376),2)."%");
		return $table;	
	
	
	}
	function _getFilialEngineer($id = false){
		$this->loadModel('Engineer');
		if($id){
			$this->Engineer->recursive = -1;
			$engineer = $this->Engineer->find('all',array('conditions'=>array('Engineer.id'=>$id)));
			return $engineer[0]['Engineer']['filial_id'];
		}
	
	}
	

	function reportePorFecha(){
		$this->set('title_for_layout','Sistema de reportes | Reporte total');
		if(!$this->data){
			$this->set('show',false);
		}
		else{
			
			$this->set('show',true);

		if($this->data){
			$etapa = null;
			$start = $this->data['Reporte']['start_date'];
			$end = $this->data['Reporte']['end_date'];
			switch($etapa){
				case 2:
						$fase = 2;
						$fecha = '<';
						$this->set('title_for_layout','Sistema de reportes | Reporte fase 2');
						break;
				case 3:
						//$fase = 3;
						$fecha = '>=';
					$this->set('title_for_layout','Sistema de reportes | Reporte fase 3');
						break;
				default:
					$this->set('title_for_layout','Sistema de reportes | Reporte entre '.$start.' y '.$end);
					break;
			}
				
		}
	
		
//		$this->set('title_for_layout','Sistema de reportes | Reporte');
		if(isset($fecha)){
		$reunionesTotales  = $this->Tworeport->find("count",array('conditions'=>'Tworeport.fecha '.$fecha." '2011-06-01'"));
		} //CONDICION DE FECHA !!!!!!!!!!
		else{
		$reunionesTotales  = $this->Tworeport->find("count",array('conditions'=>array('Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
		}

		$ingenieros = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<>5")));
		$this->Engineer->recursive = -1;
		$ingenierosNombre = $this->Engineer->find("all",array("conditions"=>array("Engineer.filial_id<>5")));
		
		
		$ingenierosNombre1 = array();
		foreach($ingenierosNombre as $value){
			$ingenierosNombre1[$value['Engineer']['id']] = $value['Engineer']['nombre'];
		}

		$actividades = array(6,11,9,10);
		//planificacion, taller, grupo evaluador, GRUPO MEJORA
		$filiales = $this->Filial->find("list",array("conditions"=>array("Filial.id <= "=>3)));
		$ingFilial = array();
		//pr($filiales);
		foreach($filiales as $key=>$value){
			$ingFilial[$key] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id"=>$key)));
			
			
		}
		
		$cuentasdereporte= array();
		$sumaActividades = array();
		$sumaActividades[0] = "Totales";
		$sumaActividades[6] = 0;
		$sumaActividades[11] = 0;
		$sumaActividades[9] = 0;
		$sumaActividades[10] = 0;
		$sumaActividades[12] = 0;
		$unidadesPlanificacion = array(1,2,3,5,8,10,14,11,17,15,13,16,12);
		foreach($ingFilial as $k => $v){
			foreach($v as $key=>$value){
				$cuentasdereporte[$key][0] = $ingenierosNombre1[$key];
				$suma = 0;
				foreach ($actividades as $a){
					if(isset($fecha)){
						$cuentasdereporte[$key][$a] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$key,"Tworeport.activity_id"=>$a,"Tworeport.state_id" => 2,'Tworeport.fecha '.$fecha." '2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					}
					else{
						$cuentasdereporte[$key][$a] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$key,"Tworeport.activity_id"=>$a,"Tworeport.state_id" => 2,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
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
			$ideasTotales = $this->Onereport->find("count",array('conditions'=>array('Onereport.fecha '.$fecha." '2011-06-01'")));
		
		}
		else{
			$ideasTotales = $this->Onereport->find("count",array('conditions'=>array('Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
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
				$cuentasdeideas[$key][$k] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>$k,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
			}
			

			}
			
		}
		$ingFilialIdeas = $ingFilial;
		$ingFilialReportes = $ingFilial;

		foreach($ingFilialIdeas as $key=>&$value){
			foreach($value as $k=>&$v){
				$value[$k] = $cuentasdeideas[$k];
			}
		}
		$ingIdeas = array();
		$suma1 =0;
		$suma2=0;
		$suma3 = 0;
		$suma4=0;
		foreach($ingFilialIdeas as $key=>&$value){
			foreach($value as $k=>&$v){
				
				$total = $v[2]+$v[3];
				if($total > 0){
					$res = round(100*($v[2]/($v[2]+$v[3])),0)."%";
				}
				else{
					$res = 0;
				}
				$tmp = array($ingenierosNombre1[$k],$v[1],$v[2],$v[3],$v[4],$v[1]+$v[2]+$v[3]+$v[4],$res);
				$suma1 += $v[1];
				$suma2 += $v[2];
				$suma3 += $v[3];
				$suma4 += $v[4];
				array_push($ingIdeas,$tmp);
			}
			
		}
		//pr($ingIdeas);
		$sumas = array();
		array_push($sumas,"Total",$suma1,$suma2,$suma3,$suma4,$suma1+$suma2+$suma3+$suma4,round(100*($suma2/($suma2+$suma3)),0)."%");
		array_push($ingIdeas,$sumas);
		$this->set("ingIdeas",$ingIdeas);

		
		


		foreach($ingFilialReportes as $key=>&$value){
			foreach($value as $k=>&$v){
				//echo $k." ";
				$value[$k] = $cuentasdereporte[$k];
				///**/pr($cuentasdereporte[$k]);/**/	
			}
			
		}


		//pr($ingFilialReportes);
		
		/*** HACER DE MODO AUTOMATICO !!!! ***/
		$filialReportes=array();
		$filialReportes[0][0] = $filiales[1]; //FCEL
		$filialReportes[0][1] = $ingFilialReportes[1][2][6]+$ingFilialReportes[1][3][6]+$ingFilialReportes[1][4][6]+$ingFilialReportes[1][27][6]; //Planificacion
		$filialReportes[0][2] = $ingFilialReportes[1][2][11]+$ingFilialReportes[1][3][11]+$ingFilialReportes[1][4][11]+$ingFilialReportes[1][27][11]; //Talleres
		$filialReportes[0][3] = $ingFilialReportes[1][2][9]+$ingFilialReportes[1][3][9]+$ingFilialReportes[1][4][9]+$ingFilialReportes[1][27][9]; //Grupo Evaluador
		$filialReportes[0][4] = $ingFilialReportes[1][2][10]+$ingFilialReportes[1][3][10]+$ingFilialReportes[1][4][10]+$ingFilialReportes[1][27][10]; //Equipo de Mejora
		$filialReportes[0][5] = $filialReportes[0][1] + $filialReportes[0][2] +$filialReportes[0][3] +$filialReportes[0][4]; //Total

		$filialReportes[1][0] = $filiales[2]; //BASA
		$filialReportes[1][1] = $ingFilialReportes[2][1][6]+$ingFilialReportes[2][5][6]+$ingFilialReportes[2][28][6];
		$filialReportes[1][2] = $ingFilialReportes[2][1][11]+$ingFilialReportes[2][5][11]+$ingFilialReportes[2][28][11];
		$filialReportes[1][3] = $ingFilialReportes[2][1][9]+$ingFilialReportes[2][5][9]+$ingFilialReportes[2][28][9];
		$filialReportes[1][4] = $ingFilialReportes[2][1][10]+$ingFilialReportes[2][5][10]+$ingFilialReportes[2][28][10];
		$filialReportes[1][5] = $filialReportes[1][1] + $filialReportes[1][2] +$filialReportes[1][3] +$filialReportes[1][4];

		$filialReportes[2][0] = $filiales[3]; //FVAL
		$filialReportes[2][1] = $ingFilialReportes[3][6][6];
		$filialReportes[2][2] = $ingFilialReportes[3][6][11];
		$filialReportes[2][3] = $ingFilialReportes[3][6][9];
		$filialReportes[2][4] = $ingFilialReportes[3][6][10];
		$filialReportes[2][5] = $filialReportes[2][1] + $filialReportes[2][2] +$filialReportes[2][3] +$filialReportes[2][4];

		$filialReportes[3][0] = "Totales"; //TOTALES
		$filialReportes[3][1] = $ingFilialReportes[1][2][6]+$ingFilialReportes[1][3][6]+$ingFilialReportes[1][4][6]+$ingFilialReportes[1][27][6] + $ingFilialReportes[2][1][6]+$ingFilialReportes[2][5][6]+$ingFilialReportes[2][28][6] +$ingFilialReportes[3][6][6];
		$filialReportes[3][2] = $ingFilialReportes[1][2][11]+$ingFilialReportes[1][3][11]+$ingFilialReportes[1][4][11]+$ingFilialReportes[1][27][11]+ $ingFilialReportes[2][1][11]+$ingFilialReportes[2][5][11]+$ingFilialReportes[2][28][11] +$ingFilialReportes[3][6][11];
		$filialReportes[3][3] = $ingFilialReportes[1][2][9]+$ingFilialReportes[1][3][9]+$ingFilialReportes[1][4][9]+$ingFilialReportes[1][27][9]+$ingFilialReportes[2][1][9]+$ingFilialReportes[2][5][9]+$ingFilialReportes[2][28][9]+$ingFilialReportes[3][6][9];
		$filialReportes[3][4] = $ingFilialReportes[1][2][10]+$ingFilialReportes[1][3][10]+$ingFilialReportes[1][4][10]+$ingFilialReportes[1][27][10]+$ingFilialReportes[2][1][10]+$ingFilialReportes[2][5][10]+$ingFilialReportes[2][28][10]+$ingFilialReportes[3][6][10];
		$filialReportes[3][5] = $filialReportes[3][1] + $filialReportes[3][2] +$filialReportes[3][3] +$filialReportes[3][4];
		/*** FIN ***/
		
		//pr($filialReportes);
		
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
					$uno += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>1,"Onereport.ideasstate_id"=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
					$dos += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>2,"Onereport.ideasstate_id"=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));	
					$tres += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>3,"Onereport.ideasstate_id"=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
					$cuatro += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>4,"Onereport.ideasstate_id"=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));	
					$cinco += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.proyectostate_id"=>6,"Onereport.ideasstate_id"=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));	
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
		
		//Begin ideas for unities
		$unities = $this->Unity->find('list',array('conditions'=>array('id!= 11','id!=9')));
		$eProyecto = array();
		$totales = array();
		$unitiesSum = array();

		foreach($ingFilial as $k=>$v){
			$unitiesSum[$k] = array();
			foreach($v as $kk=>$vv){
				if(isset($fecha)){
					$i=0;
					foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'")));	
					else $unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'")));				
				}
			}
			else{
				foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))	$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));						
					else{
							$unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));						
						}
					}				
				}
			}
		}
		$unitiesSum[1][0] = 'FCEL';
		$unitiesSum[2][0] = 'BASA';
		$unitiesSum[3][0] = 'FVAL';		
				$this->set("ideasFilialUnidadGrafico",$unitiesSum);
		$this->set('unities',$unities);
		
		//end ideas for unities



//Begin project for unities
		$unities = $this->Unity->find('list');
		$eProyecto = array();
		$totales = array();
		$unitiesSum = array();

		foreach($ingFilial as $k=>$v){
			$unitiesSum[$k] = array();
			foreach($v as $kk=>$vv){
				if(isset($fecha)){
					$i=0;
					foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'",'Onereport.ideasstate_id'=>2)));	
					else $unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha '.$fecha."'2011-06-01'",'Onereport.ideasstate_id'=>2)));					
				}
			}
			else{
				foreach($unities as $keyUnity => $unity){
					if(!array_key_exists($keyUnity,$unitiesSum[$k]))	$unitiesSum[$k][$keyUnity] = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.ideasstate_id'=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));						
					else{
							$unitiesSum[$k][$keyUnity] += $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$kk,"Onereport.unity_id"=>$keyUnity,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));						
						}
					}				
				}
			}
		}
		$unitiesSum[1][0] = 'FCEL';
		$unitiesSum[2][0] = 'BASA';
		$unitiesSum[3][0] = 'FVAL';		
		$unitiesSum[1][11] = $unitiesSum[1][7]+$unitiesSum[1][12]+$unitiesSum[1][13]+$unitiesSum[1][14]+$unitiesSum[1][15]+$unitiesSum[1][16]; 
		$unitiesSum[2][11] = $unitiesSum[2][7]+$unitiesSum[2][12]+$unitiesSum[2][13]+$unitiesSum[2][14]+$unitiesSum[2][15]+$unitiesSum[2][16]; 
		$unitiesSum[3][11] = $unitiesSum[3][7]+$unitiesSum[3][12]+$unitiesSum[3][13]+$unitiesSum[3][14]+$unitiesSum[3][15]+$unitiesSum[3][16]; 
		$unitiesSum[1][18] = $unitiesSum[1][17]+$unitiesSum[1][10];
		$unitiesSum[2][18] = $unitiesSum[2][17]+$unitiesSum[2][10];
		$unitiesSum[3][18] = $unitiesSum[3][17]+$unitiesSum[3][10];
		$this->set("proyectosFilialUnidadGrafico",$unitiesSum);		
		//end projects for unities





/////// Reporte de realizadas no realizadas replanificadas por ingeniero en taller,planificacion, grupo de {mejora,evaluador}
	$i=1;
	$j=1;
	foreach($ingFilial as $k => $v){
		foreach($v as $key=>$val){
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Talleres"; 
				if(isset($fecha)){
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Planificación";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));	

				$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo Evaluador";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));	


					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo de Mejora";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>array(2,3,4),'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>2,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>3,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>4,'Tworeport.fecha '.$fecha."'2011-06-01'","Tworeport.unity_id"=>$unidadesPlanificacion)));	
				$i=1;
				$j=1;

				}
				
				else{
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>array(2,3,4),'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>11,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Planificación";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>array(2,3,4),"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>6,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));	

				$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo Evaluador";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>array(2,3,4),"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>9,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));	


					$i=1;
					$j++;
				$planificaciones[$key][$j] = array();
				$planificaciones[$key][$j][0] = $ingenierosNombre1[$key]." - Grupo de Mejora";
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>array(2,3,4))));
							$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>2,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;		
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>3,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));
					$i++;
				$planificaciones[$key][$j][$i] = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=> $key,"Tworeport.activity_id"=>10,"state_id"=>4,"Tworeport.unity_id"=>$unidadesPlanificacion,'Tworeport.fecha >='=>$start,'Tworeport.fecha <='=>$end)));	
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

   //Cambiar este codigo para hacerlo dinamico. Dentro de los $P esta el arreglo de ingenieros, solo sirve para el los ingenieros definidos, si se agrega uno nuevo, se debe modifiar codigo.
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
			$porcentaje = $sumaR+$sumaNR+$sumaRep;
			if($porcentaje == 0){
				$porcentaje =0;
			}
			else{
				$porcentaje = round(100*$sumaR/($sumaR+$sumaNR+$sumaRep));
			}
			
			array_push($sumas,"Subtotal",$sumaR+$sumaNR+$sumaRep,$sumaR,$sumaNR,$sumaRep,$porcentaje."%" );
			$p[8] = $sumas;
			if(($p[0][2]+$p[0][3]+$p[0][4])>0)$p[0][5] = round((100*($p[0][2])/($p[0][2]+$p[0][3]+$p[0][4])), 0)."%";
			else{
				$p[0][5] = "0%";
				
			}
			if(($p[1][2]+$p[1][3]+$p[1][4])>0)$p[1][5] = round(((100*$p[1][2])/($p[1][2]+$p[1][3]+$p[1][4])), 0)."%";
			else{
				$p[1][5] = "0%";
				
			}
			if(($p[2][2]+$p[2][3]+$p[2][4])>0)$p[2][5] = round(((100*$p[2][2])/($p[2][2]+$p[2][3]+$p[2][4])), 0)."%";
			else{
				$p[2][5] = "0%";
				
			}
			if(($p[3][2]+$p[3][3]+$p[3][4])>0)$p[3][5] = round(((100*$p[3][2])/($p[3][2]+$p[3][3]+$p[3][4])), 0)."%";
			else{
				$p[3][5] = "0%";
				
			}
			if(($p[4][2]+$p[4][3]+$p[4][4])>0)$p[4][5] = round(((100*$p[4][2])/($p[4][2]+$p[4][3]+$p[4][4])), 0)."%";
			else{
				$p[4][5] = "0%";
				
			}
			if(($p[5][2]+$p[5][3]+$p[5][4])>0)$p[5][5] = round(((100*$p[5][2])/($p[5][2]+$p[5][3]+$p[5][4])), 0)."%";
			else{
				$p[5][5] = "0%";
				
			}
			if(($p[6][2]+$p[6][3]+$p[6][4])>0)$p[6][5] = round(((100*$p[6][2])/($p[6][2]+$p[6][3]+$p[6][4])), 0)."%";
			else{
				$p[6][5] = "0%";
				
			}
			if(($p[7][2]+$p[7][3]+$p[7][4])>0)$p[7][5] = round(((100*$p[7][2])/($p[7][2]+$p[7][3]+$p[7][4])), 0)."%";
			else{
				$p[7][5] = "0%";
				
			}

			
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
				/*Haciendo arreglos, solo para proyectos != de estados pendiente y aprobados*/
//				$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1,'Onereport.fecha '.$fecha."'2011-06-01'")));
 					$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoAprobado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoRechazado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>3,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoReproceso = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>4,"Onereport.fecha ".$fecha." '2011-06-01'")));
					$proyectoPreparacion = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>6,"Onereport.fecha ".$fecha." '2011-06-01'")));
				}
				else{
				$proyectoPendiente = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>1,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
				$proyectoAprobado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>2,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
				$proyectoRechazado = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>3,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
				$proyectoReproceso = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>4,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
				$proyectoPreparacion = $this->Onereport->find("count",array("conditions"=> array("Onereport.engineer_id"=>$key,"Onereport.ideasstate_id"=>2,"Onereport.proyectostate_id"=>6,'Onereport.fecha >='=>$start,'Onereport.fecha <='=>$end)));
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


		$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id = 1 group by emsefor_id order by count(*) desc";
		$sumas = array();
		$i = 0;
		$cantEmsefor = array(129,92,40);
		foreach ($ingFilial as $k=>$v){
			$sumaEmsefor6 = 0;
			$sumaProyecto1 = 0;
			$count6 = array();
			$count2 = array();
			$porcentaje = array();
			foreach($v as $key=>$value){
				$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id =".$key." and fecha >= ".$start." and fecha <=".$end." group by emsefor_id order by count(*) desc";

				$count6 = $this->Onereport->query($sql);
				foreach($count6 as $veces){

					if($veces[0]['veces'] >0){
						$sumaEmsefor6 += 1;
						
					}

				}
				$sql = "select count(*) as veces,emsefor_id from onereports where engineer_id =".$key." and (proyectostate_id = 2 or proyectostate_id = 3 or proyectostate_id = 4) and fecha >= ".$start." and fecha <= ".$end." group by emsefor_id order by count(*) desc";
			
				$count2 = $this->Onereport->query($sql);
			foreach($count2 as $veces){
				if($veces[0]['veces'] > 0){
					$sumaProyecto1 += 1;
				}

			}
			
			
			}	
			$sumas[$i] = array(0=>$filiales[($i+1)],1=>$cantEmsefor[$i],2=>$sumaEmsefor6,3=>'',4=>$sumaProyecto1,5=>round(100*$sumaProyecto1/$cantEmsefor[$i])."%");
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
			$sumas[0][3] = round(100*$sumas[0][2]/$cantEmsefor[0],0)."%"; 
			$sumas[1][3] = round(100*$sumas[1][2]/$cantEmsefor[1],0)."%";
			$sumas[2][3] = round(100*$sumas[2][2]/$cantEmsefor[2],0)."%";

			$suma = array();
			array_push($suma,"Total",$suma1,$suma2,round(100*$suma2/($cantEmsefor[0]+$cantEmsefor[1]+$cantEmsefor[2]),0)."%",$sumas[0][4]+$sumas[1][4]+$sumas[2][4],round(100*($sumas[0][4]+$sumas[1][4]+$sumas[2][4])/$suma1)."%");

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
			$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1  and fecha >= ".$start." and fecha <= ".$end." ORDER BY `Tworeport`.`semana` DESC ");
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
		if(isset($fecha)){
			$this->set('ideasEmsefor',$this->_ideasEmsefor($fecha));
			$this->set('projectsEmsefor',$this->_projectsEmsefor($fecha));

			$this->set('planificationUnities',$this->_planificationUnities(true,$fecha));
			$this->set('ideasUnities',$this->_ideasUnities(true,$fecha));
			$this->set('projectsUnities',$this->_projectsUnities(true,$fecha));
			$this->set('trabajadores',$this->_getWorkersTable());

		}
		else{
		
			$this->set('ideasEmsefor',$this->_ideasEmsefor($start,$end));
			$this->set('projectsEmsefor',$this->_projectsEmsefor($start,$end));
			$this->set('planificationUnities',$this->_planificationUnities(null,$start, $end));
			$this->set('ideasUnities',$this->_ideasUnities(null,$start,$end));
			$this->set('projectsUnities',$this->_projectsUnities(null,$start,$end));
		}
		
		
	
		}
	
	}
		
		
		
}
?>
