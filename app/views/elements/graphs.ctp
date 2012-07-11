<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      reunionesPorIngeniero = new Highcharts.Chart({
         chart: {
            renderTo: 'reunionesIngeniero',
            type: 'column'
         },
         title: {
            text: 'Reuniones por ingeniero efectivamente realizadas'
         },
         xAxis: {
            categories: ['Planificación', 'Talleres', 'Grupo evaluador','Equipo de mejora']
         },
         yAxis: {
            title: {
               text: 'Reuniones realizadas'
            }
         },
          plotOptions: {
        column: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },
         series: [
         <?php
         	$numero = count($reporte2);
         	$i=1;
         	foreach($reporte2 as $k=>$v){
         			if($k != 24){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[6].",".$v[11].",".$v[9].",".$v[10]."]\n},";
							}
					}
         ?>
          ]
      });
      
      reunionesPorFilial = new Highcharts.Chart({
         chart: {
            renderTo: 'reunionesFilial',
            type: 'column'
         },
         title: {
            text: 'Reuniones por Filial efectivamente realizadas'
         },
         xAxis: {
            categories: ['Planificación', 'Talleres', 'Grupo evaluador','Equipo de mejora']
         },
         yAxis: {
            title: {
               text: 'Reuniones realizadas'
            }
         },
          plotOptions: {
        column: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },

         series: [
         <?php
         	$numero = count($reporte2);
         	$i=1;
         	foreach($ingFilialReportes as $k=>$v){
  	   			if($k != 3){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4]."]\n},";
						}
					}
         ?>
          ]
      });
         
      ideasIngenieros = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasIngeniero',
            type: 'column'
         },
         title: {
            text: '	Ideas por ingeniero'
         },
         xAxis: {
            categories: ['Pendiente', 'Aprobadas', 'Rechazadas','Reproceso']
         },
         yAxis: {
            title: {
               text: 'Número de ideas'
            }
         },
          plotOptions: {
        column: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },

         series: [
         <?php
         	foreach($ingIdeas as $k=>$v){
  	   			if($k != 9){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4]."]\n},";
						}
					}
         ?>
          ]
      });
      
      ideasFilial = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasFilial',
            type: 'column'
         },
         title: {
            text: '	Ideas por filial'
         },
         xAxis: {
            categories: ['Pendiente', 'Aprobadas', 'Rechazadas','Reproceso']
         },
         yAxis: {
            title: {
               text: 'Número de ideas'
            }
         },
          plotOptions: {
        column: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },

         series: [
         <?php
         	foreach($filialIdeas as $k=>$v){
  	   			if($k != 4){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4]."]\n},";
						}
					}
         ?>
          ]
      });
      
      estadoProyectos = new Highcharts.Chart({
         chart: {
            renderTo: 'estadoProyectosFilial',
            type: 'column'
         },
         title: {
            text: '	Proyectos por filial'
         },
         xAxis: {
            categories: ['Pendiente', 'En preparación', 'En revisión','Aprobado','Rechazado']
         },
         yAxis: {
            title: {
               text: 'Número de proyectos'
            }
         },
          plotOptions: {
        column: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },

         series: [
         <?php
         	foreach($eProyecto as $k=>$v){
  	   			if($k != 4){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4].",".$v[5]."]\n},";
						}
					}
         ?>
          ]
      }); 
      
      estadoProyectosIngeniero = new Highcharts.Chart({
         chart: {
            renderTo: 'estadoProyectosIngeniero',
            type: 'column'
         },
         title: {
            text: '	Proyectos por ingeniero'
         },
         xAxis: {
            categories: ['Pendiente', 'En preparación', 'En revisión','Aprobado','Rechazado']
         },
         yAxis: {
            title: {
               text: 'Número de proyectos'
            }
         },
          plotOptions: {
        column: {
            dataLabels: {
               enabled: true
            },
            enableMouseTracking: false
         }
      },

         series: [
         <?php
         	foreach($proyectoIngeniero as $k=>$v){
  	   			if($k != 24){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4].",".$v[5]."]\n},";
						}
					}
         ?>
          ]
      });      
      ideasFilialUnidad = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasFilialUnidad',
            type: 'bar'
         },
         title: {
            text: '	Ideas por filial/unidad'
         },
         xAxis: {
            categories: [ 
            	<?php
            	$i=0;
            	//pr($ideasFilialUnidadGrafico);
            	foreach($ideasFilialUnidadGrafico[1] as $key=>$value){
            		if($key!=0 && $key!=18)	{
            		if($i==0)	echo "'".$unities[$key]."'";
            		else echo ",'".$unities[$key]."'";
            		$i++;
            		
            		}
            	}?>
            	]
         },
         yAxis: {
            title: {
               text: 'Ideas'
            }
         },
         plotOptions: {
        	lineWidth: 10,
        	column:{
        	 dataLabels: {
        	 	enabled: true
        	 },
        	 enableMousTracking: false
        	},
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         			
        	   	for($j=1;$j<=3;$j++){
        	   	
         			echo "{name: '".$ideasFilialUnidadGrafico[$j][0] ."',";
							echo "data:[";
							$i=0;
							foreach($ideasFilialUnidadGrafico[$j] as $key=>$ideas){
								if($key != 0){
									if($i==0)	echo "".$ideas."";
									else{
										echo ",".$ideas."";
									}
									$i++;
								}
							}
							echo "]},\n";
							
							}
						
							
					
         ?>
         ]
          
      });   
      //begin projects unities
      proyectosFilialUnidad = new Highcharts.Chart({
         chart: {
            renderTo: 'proyectosFilialUnidad',
            type: 'bar'
         },
         title: {
            text: '	Proyectos por filial/unidad'
         },
         xAxis: {
            categories: [ 
            	<?php
            	$i=0;
            	foreach($proyectosFilialUnidadGrafico[1] as $key=>$value){
            		if($key!=0 && $key!=18 && $key!=9 && $key!= 11)	{
            		if($i==0)	echo "'".$unities[$key]."'";
            		else echo ",'".$unities[$key]."'";
            		$i++;
            		
            		}
            	}?>
            	]
         },
         yAxis: {
            title: {
               text: 'Proyectos'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         			
        	   	for($j=1;$j<=3;$j++){
        	   	
         			echo "{name: '".$proyectosFilialUnidadGrafico[$j][0] ."',";
							echo "data:[";
							$i=0;
							foreach($proyectosFilialUnidadGrafico[$j] as $key=>$ideas){
								if($key != 0){
									if($i==0)	echo "".$ideas."";
									else{
										echo ",".$ideas."";
									}
									$i++;
								}
							}
							echo "]},\n";
							
							}
						
							
					
         ?>
         ]
          
      });     
      //end projects unities
      
      //Begin planificationUnities graph FCEL
        planificationUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'planificationUnitiesFCEL',
            type: 'bar'
         },
         title: {
            text: '	Reuniones por unidad/actividad: FCEL'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($planificationUnities[1] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Proyectos'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Planificación',data:[";
         	$i=0;
        	foreach($planificationUnities[1] as $key=>$value){
        		if($i==0) {
        			echo "".$value[6]."";
        			$i++;
        		}
				else echo ",".$value[6]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Talleres',data:[";
         	$i=0;
        	foreach($planificationUnities[1] as $key=>$value){
        		if($i==0) {
        			echo "".$value[11]."";
        			$i++;
        		}
				else echo ",".$value[11]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Grupo Evaluador',data:[";
         	$i=0;
        	foreach($planificationUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[9]."";
        			$i++;
        		}
				else echo ",".$value[9]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Equipo de mejora',data:[";
         	$i=0;
        	foreach($planificationUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[10]."";
        			$i++;
        		}
				else echo ",".$value[10]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });
      
      //End planificationUnities graph
      
       planificationUnities2 = new Highcharts.Chart({
         chart: {
            renderTo: 'planificationUnitiesBASA',
            type: 'bar'
         },
         title: {
            text: '	Reuniones por unidad/actividad: BASA'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($planificationUnities[1] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Proyectos'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Planificación',data:[";
         	$i=0;
        	foreach($planificationUnities[2] as $key=>$value){
        		if($i==0) {
        			echo "".$value[6]."";
        			$i++;
        		}
				else echo ",".$value[6]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Talleres',data:[";
         	$i=0;
        	foreach($planificationUnities[2] as $key=>$value){
        		if($i==0) {
        			echo "".$value[11]."";
        			$i++;
        		}
				else echo ",".$value[11]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Grupo Evaluador',data:[";
         	$i=0;
        	foreach($planificationUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[9]."";
        			$i++;
        		}
				else echo ",".$value[9]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Equipo de mejora',data:[";
         	$i=0;
        	foreach($planificationUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[10]."";
        			$i++;
        		}
				else echo ",".$value[10]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });
      
      //End planificationUnities graph

 planificationUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'planificationUnitiesFVAL',
            type: 'bar'
         },
         title: {
            text: '	Reuniones por unidad/actividad: FVAL'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($planificationUnities[1] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Proyectos'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Planificación',data:[";
         	$i=0;
        	foreach($planificationUnities[3] as $key=>$value){
        		if($i==0) {
        			echo "".$value[6]."";
        			$i++;
        		}
				else echo ",".$value[6]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Talleres',data:[";
         	$i=0;
        	foreach($planificationUnities[3] as $key=>$value){
        		if($i==0) {
        			echo "".$value[11]."";
        			$i++;
        		}
				else echo ",".$value[11]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Grupo Evaluador',data:[";
         	$i=0;
        	foreach($planificationUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[9]."";
        			$i++;
        		}
				else echo ",".$value[9]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Equipo de mejora',data:[";
         	$i=0;
        	foreach($planificationUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[10]."";
        			$i++;
        		}
				else echo ",".$value[10]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });
      
      //End planificationUnities graph

      
      
      
      //Begin ideasUnities graph
        ideasUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasUnitiesFCEL',
            type: 'bar'
         },
         title: {
            text: '	Ideas por unidad/estado para FCEL'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($ideasUnities[1] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Estados'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Pendiente',data:[";
         	$i=0;
        	foreach($ideasUnities[1] as $key=>$value){
        		if($i==0) {
        			echo "".$value[1]."";
        			$i++;
        		}
				else echo ",".$value[1]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Aprobadas',data:[";
         	$i=0;
        	foreach($ideasUnities[1] as $key=>$value){
        		if($i==0) {
        			echo "".$value[2]."";
        			$i++;
        		}
				else echo ",".$value[2]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Rechazadas',data:[";
         	$i=0;
        	foreach($ideasUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[3]."";
        			$i++;
        		}
				else echo ",".$value[3]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Reproceso',data:[";
         	$i=0;
        	foreach($ideasUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[4]."";
        			$i++;
        		}
				else echo ",".$value[4]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });
      
      
      //End ideasUnities graph
      
      ideasUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasUnitiesBASA',
            type: 'bar'
         },
         title: {
            text: '	Ideas por unidad/estado para BASA'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($ideasUnities[2] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Estados'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Pendiente',data:[";
         	$i=0;
        	foreach($ideasUnities[2] as $key=>$value){
        		if($i==0) {
        			echo "".$value[1]."";
        			$i++;
        		}
				else echo ",".$value[1]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Aprobadas',data:[";
         	$i=0;
        	foreach($ideasUnities[2] as $key=>$value){
        		if($i==0) {
        			echo "".$value[2]."";
        			$i++;
        		}
				else echo ",".$value[2]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Rechazadas',data:[";
         	$i=0;
        	foreach($ideasUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[3]."";
        			$i++;
        		}
				else echo ",".$value[3]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Reproceso',data:[";
         	$i=0;
        	foreach($ideasUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[4]."";
        			$i++;
        		}
				else echo ",".$value[4]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });
      
      
      //End ideasUnities graph
      
      ideasUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasUnitiesFVAL',
            type: 'bar'
         },
         title: {
            text: '	Ideas por unidad/estado para FVAL'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($ideasUnities[3] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Estados'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Pendiente',data:[";
         	$i=0;
        	foreach($ideasUnities[3] as $key=>$value){
        		if($i==0) {
        			echo "".$value[1]."";
        			$i++;
        		}
				else echo ",".$value[1]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Aprobadas',data:[";
         	$i=0;
        	foreach($ideasUnities[3] as $key=>$value){
        		if($i==0) {
        			echo "".$value[2]."";
        			$i++;
        		}
				else echo ",".$value[2]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Rechazadas',data:[";
         	$i=0;
        	foreach($ideasUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[3]."";
        			$i++;
        		}
				else echo ",".$value[3]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Reproceso',data:[";
         	$i=0;
        	foreach($ideasUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[4]."";
        			$i++;
        		}
				else echo ",".$value[4]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });
      
      
      //End ideasUnities graph
      
      
      
      
      //Begin projectsUnities graph
      projectsUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'projectsUnitiesFCEL',
            type: 'bar'
         },
         title: {
            text: '	Proyectos por unidad/estado para FCEL'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($projectsUnities[1] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Estados'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Pendiente',data:[";
         	$i=0;
        	foreach($projectsUnities[1] as $key=>$value){
        		if($i==0) {
        			echo "".$value[1]."";
        			$i++;
        		}
				else echo ",".$value[1]."";
        	}				
        	echo "]},";
        	echo "{'name': 'En revisión',data:[";
         	$i=0;
        	foreach($projectsUnities[1] as $key=>$value){
        		if($i==0) {
        			echo "".$value[2]."";
        			$i++;
        		}
				else echo ",".$value[2]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Aprobados',data:[";
         	$i=0;
        	foreach($projectsUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[3]."";
        			$i++;
        		}
				else echo ",".$value[3]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Rechazados',data:[";
         	$i=0;
        	foreach($projectsUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[4]."";
        			$i++;
        		}
				else echo ",".$value[4]."";
        	}				
        	echo "]},";
        	echo "{'name': 'En preparación',data:[";
         	$i=0;
        	foreach($projectsUnities[1] as $key=>$value){
        		if($i==0){
        			echo "".$value[6]."";
        			$i++;
        		}
				else echo ",".$value[6]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });


      
      //end projectsUnities graph
      
      
            //Begin projectsUnities graph
      projectsUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'projectsUnitiesBASA',
            type: 'bar'
         },
         title: {
            text: '	Proyectos por unidad/estado BASA'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($projectsUnities[2] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Estados'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Pendiente',data:[";
         	$i=0;
        	foreach($projectsUnities[2] as $key=>$value){
        		if($i==0) {
        			echo "".$value[1]."";
        			$i++;
        		}
				else echo ",".$value[1]."";
        	}				
        	echo "]},";
        	echo "{'name': 'En revisión',data:[";
         	$i=0;
        	foreach($projectsUnities[2] as $key=>$value){
        		if($i==0) {
        			echo "".$value[2]."";
        			$i++;
        		}
				else echo ",".$value[2]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Aprobados',data:[";
         	$i=0;
        	foreach($projectsUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[3]."";
        			$i++;
        		}
				else echo ",".$value[3]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Rechazados',data:[";
         	$i=0;
        	foreach($projectsUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[4]."";
        			$i++;
        		}
				else echo ",".$value[4]."";
        	}				
        	echo "]},";
        	echo "{'name': 'En preparación',data:[";
         	$i=0;
        	foreach($projectsUnities[2] as $key=>$value){
        		if($i==0){
        			echo "".$value[6]."";
        			$i++;
        		}
				else echo ",".$value[6]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });


      
      //end projectsUnities graph
      
            //Begin projectsUnities graph
      projectsUnities = new Highcharts.Chart({
         chart: {
            renderTo: 'projectsUnitiesFVAL',
            type: 'bar'
         },
         title: {
            text: '	Proyectos por unidad/estado'
         },
         xAxis: {
            categories: [ 
            <?php
            	$i=0;
            	foreach($projectsUnities[3] as $key=>$value){
            		if($i==0){
            			echo "'".$value[0]."'";
            			$i++;
            		}
            		else{
        				echo ",'".$value[0]."'";
           			}
           			
           		}
           	?>
            ]
         },
         yAxis: {
            title: {
               text: 'Estados'
            }
         },
        plotOptions: {
        	lineWidth: 10,
        	series: {
	        	stacking: 'normal'
	        },
	        bar : {
	        	dataLabels:true
	        }
      },

         series: [         	
         <?php
         	echo "{'name': 'Pendiente',data:[";
         	$i=0;
        	foreach($projectsUnities[3] as $key=>$value){
        		if($i==0) {
        			echo "".$value[1]."";
        			$i++;
        		}
				else echo ",".$value[1]."";
        	}				
        	echo "]},";
        	echo "{'name': 'En revisión',data:[";
         	$i=0;
        	foreach($projectsUnities[3] as $key=>$value){
        		if($i==0) {
        			echo "".$value[2]."";
        			$i++;
        		}
				else echo ",".$value[2]."";
        	}				
        	echo "]},";
        	         	echo "{'name': 'Aprobados',data:[";
         	$i=0;
        	foreach($projectsUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[3]."";
        			$i++;
        		}
				else echo ",".$value[3]."";
        	}				
        	echo "]},";
        	echo "{'name': 'Rechazados',data:[";
         	$i=0;
        	foreach($projectsUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[4]."";
        			$i++;
        		}
				else echo ",".$value[4]."";
        	}				
        	echo "]},";
        	echo "{'name': 'En preparación',data:[";
         	$i=0;
        	foreach($projectsUnities[3] as $key=>$value){
        		if($i==0){
        			echo "".$value[6]."";
        			$i++;
        		}
				else echo ",".$value[6]."";
        	}				
        	echo "]}";
         ?>
         ]
          
      });


      
      //end projectsUnities graph
      
      
      
      
   });	
   
   </script>
