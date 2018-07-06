function drawChartTorta(radio_selec,porcentaje,id_div) {

         Highcharts.setOptions({
             lang: {
                loading: 'Cargando...',
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                exportButtonTitle: "Exportar",
                printButtonTitle: "Importar",
                rangeSelectorFrom: "Desde",
                rangeSelectorTo: "Hasta",
                rangeSelectorZoom: "Período",
                downloadPNG: 'Descargar imagen PNG',
                downloadJPEG: 'Descargar imagen JPEG',
                downloadPDF: 'Descargar imagen PDF',
                printChart: 'Imprimir',
                resetZoom: 'Reiniciar zoom',
                resetZoomTitle: 'Reiniciar zoom',
                thousandsSep: ",",
                decimalPoint: '.'
            }
       });

          var id_div_grafico = ((id_div == undefined) ? '10': id_div);

          Highcharts.chart('chart_div_' + id_div_grafico,{
            chart:{type:'pie'},
            credits:{enabled: false},
            colors:[
                '#5575be', '#c73f48',
                ],
            title:{text: null},
               tooltip: {
                    pointFormat: '{point.y} %',
                    valueDecimals: 1,
               },

            plotOptions: {
                pie: {
                    allowPointSelect: true,                 
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                        enabled: false                       
                    }                                   
                }
            },
            legend: {
                enabled: true,
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                labelFormatter: function() {
                    return this.name + ' ' + this.y.toFixed(1) + '%';
                },
                itemStyle: {
                    fontSize: '15px'
                }
            },
           
           series: [{
                type: 'pie',
                name: this.name,
                data: [
                    ['Si', radio_selec],
                    ['No', porcentaje]
             
                ]
            }]
          });
         
}


//***************************************************************//
//****************************************************************//

 function drawChartTortaResumen(radio_selec,porcentaje,id_div) {
      
       var id_div_grafico = ((id_div == undefined) ? '10': id_div);
       
         Highcharts.chart('chart_graph_' + id_div_grafico,{
            chart:{type:'pie'},
            credits:{enabled: false},
            colors:[
                '#5575be', '#c73f48',
                ],
            title:{text: null},
                tooltip: {
                    pointFormat: '{point.y} %',
                    valueDecimals: 1,
               },
            plotOptions: {
                pie: {
                    allowPointSelect: true,                 
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                        enabled: false                       
                    }                                   
                }
            },
            legend: {
                enabled: true,
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                labelFormatter: function() {
                    return this.name + ' ' + this.y.toFixed(1) + '%';
                },
                itemStyle: {
                    fontSize: '15px'
                }
            },
            series: [{
                type: 'pie',
                dataLabels:{
                    
                },
                data: [
                    ['Si', radio_selec],
                    ['No', porcentaje]
             
                ]
            }]
          });
          
}

//***************************************************************/
//****************************************************************//
function drawChartIndiceMunicipal(indice_integral,gestion_mejorar) {

    var data = [2,15,20,30,33];
    var dataSum = 0;
    for (var i=0;i < data.length;i++) {
        dataSum += data[i]
    }

    Highcharts.chart('indice_grafico', {

        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },                
        
         tooltip: {
              enabled: true,
               style: {fontSize: '14pt'},
             formatter: function() {
               if (status) {
                  return  '{series.name}: <b>{point.percentage:.1f}%</b>'

            } else {
            return  this.percentage.toFixed(2) + " % ";
            }
          }

       },

        xAxis: {
            categories: ['']
        },
        yAxis: {  
            min: 0,
            max:100,
            title: {
                text: ''
            },
           labels: {
            formatter:function() {
                var pcnt = (this.value / dataSum) * 100;
                return Highcharts.numberFormat(pcnt,0,',') + '%';
            }
          }
        },
        legend: {
            reversed: false,
            itemStyle: {
                fontSize: '15px',
                color: '#000',
                 fontFamily: 'bold 16px "Trebuchet MS", Verdana, sans-serif'

            },

        },
        plotOptions: {
            series: {
              stacking: 'normal',
              borderWidth:0,
              dataLabels:{
              enabled:true,
               color: '#020202',
               style: { fontFamily: '\'Verdana\', Trebuchet MS', lineHeight: '18px', fontSize: '16px' }
              
              },
              style: {
                color: '#FF00FF',
                fontWeight: 'bold'
              }
            }
        },
         labels: {
               style: {fontSize: '14pt'},
            formatter:function() {
                var pcnt = (this.value / dataSum) * 100;
                return Highcharts.numberFormat(pcnt,0,',') + '%';
            }
        },

        series: [{
            color: '#ff5656',
            name: 'Gestión por Mejorar',
            data: [gestion_mejorar]
            
        },{
            color: '#00bbff',
            name: 'Indice Integral de Inclusión Municipal',
            data: [indice_integral]
        }]
    });
}