$(document).ready(function() {

   //para refrescar el combo de factores reporte 5
      $('select[name="periodo_id"]').on('change', function() {
            var stateID = $(this).val();

          if(stateID) {
                $.ajax({
                    url: 'factor_municipalidad/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="factor_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="factor_id"]').append('<option value="'+ value.nombre +'">'+ value.nombre+'</option>');
                            $('#btn_factor').removeClass('disabled');
                        });
                       
                          if(data == ""){
                            $('select[name="factor_id"]').append('<option value="0">'+'«« No hay Factor Asociado »»'+'</option>');
                             $('#btn_factor').addClass('disabled');
                            jQuery('#chart-div_factor div').html('');
                          }
                    },
                      

                      fail: function(jqXHR, textStatus, errorThrown){ 
                      alert('Error: ' + jqXHR.responseText); 
        
                     }
                 });
              }else{
              
                $('select[name="factor_id"]').empty();
                
            }
    });
   

 //para refrescar el combo de dimensiones reporte 3
      $('select[name="periodo_id"]').on('change', function() {
            var stateID = $(this).val();

          if(stateID) {
                $.ajax({
                    url: 'dimension_municipalidad/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="dimension_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="dimension_id"]').append('<option value="'+ value.id +'">'+ value.nombre+'</option>');
                            $('#btn_dimension').removeClass('disabled');
                        });
                       
                          if(data == ""){
                            $('select[name="dimension_id"]').append('<option value="0">'+'«« No hay Dimension Asociada »»'+'</option>');
                             $('#btn_dimension').addClass('disabled');
                            jQuery('#chart_div_dimension div').html('');
                          }
                    },
                      

                      fail: function(jqXHR, textStatus, errorThrown){ 
                      alert('Error: ' + jqXHR.responseText); 
        
                     }
                 });
              }else{
              
                $('select[name="dimension_id"]').empty();
                
            }
    });

});

/*******************************************************/
/*******************************************************/


function ajax_reporte(ruta, div, form,div_reporte) {
      
  $.ajax({ 
    url: ruta,
    data: ((form != undefined) ? $('#' + form).serialize(): ""),
      method: ((form != undefined) ? 'POST' : 'GET'),
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
     dataType: 'json',
    success: function(data) {
     
           var modulo = data[2];

            if(modulo == 'porcentajeMunicipio'){

            grafica_municipio(data[0],data[1]);
          }else{
             if(modulo == 'porcentajeDimension'){

            grafica_dimension(data[0],data[1]);

            
          }else{

            if(modulo == 'dimensionMunicipalidad'){

            grafica_dimension_municipalidad(data[0],data[1]);

             

          }else{

            if(modulo == 'porcentajeFactor'){

            grafica_porcentaje_factor(data[0],data[1]);


          }else{
             grafica_porcentaje_factormunicipalidad(data[0],data[1]);

          }
         
         }

        }
      }

      $('#' + div).html(data); 
             
    },
    fail: function(jqXHR, textStatus, errorThrown){ 
      alert('Error: ' + jqXHR.responseText); 
        
    }
    
  });
  
    return false;
  
}


//Menu 1
function grafica_municipio(data,promedio){

    var chartSeriesData = [];

    var chartCategory = [];
   $.each(data, function(key, value) {
             var series_name = this.nombre;
             var series_data = ((this.porcentaje == 'NaN' || this.porcentaje == null) ? 0:this.porcentaje);
                           
          var series = [
                    series_name,
                    parseFloat(series_data)
                       ];
             chartSeriesData.push(series);   


        });
     console.log(chartSeriesData);
     
  Highcharts.chart('container_municipios', {
    chart: {
        type: 'column',
         
    },
    title: {
        text: 'Porcentaje IMDIS municipios'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        title: {
            text: 'Municipalidades'
        },
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        max:100,
        visible: true,
        title: {
            text: 'Porcentaje (%)'
        },
      
        plotLines: [{
      
        color: ((promedio == "0") ?"":'red'),
        value: promedio, 
        width: '1',
        zIndex: 2,
         tooltip: {
            pointFormat: '<span style="font-weight: bold;">'+ promedio.toFixed(2) +'</b>',
        }


                  
       }]
       
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Porcentaje: <b>{point.y}</b>'+ " " + ' Promedio: <b>' + promedio.toFixed(2) + '</b>',

    },

    series: [{
        name: 'Municipalidades',
         data:chartSeriesData,

          
        dataLabels: {
           
            enabled: true,
            rotation: -90,
            color: '#262626',
            align: 'right',
            format: '{point.y:.0f} %', // one decimal
            y: -20, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            },
            crop: false,
            overflow: 'none'
        }
      }]
   
  });

}

//Menu 2
function grafica_dimension(data,promedio){

   var chartSeriesData = [];

    var chartCategory = [];
   $.each(data, function(key, value) {
             var series_name = this.nombre;
             var series_data = this.porcentaje;
                           
          var series = [
                    series_name,
                    parseFloat(series_data)
                       ];
             chartSeriesData.push(series);   
             chartCategory.push(series_name);   

        });


  Highcharts.chart('container_cumplimiento_dimension', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Porcentaje por Cumplimiento Dimensión Nacional'
    },
    xAxis: {    
        categories: chartCategory
    },
    yAxis: {
        min: 0,
        max:100,
        title: {
            text: 'Dimensión'
        }
    },
    legend: {
        reversed: false
    },

    tooltip: {
        pointFormat: 'Porcentaje: <b>{point.y:.2f}</b>',

    },
      plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                formatter:function() {
                    return this.point.y.toFixed(2) + '%';
                }
            }
        }
    },

    series: [{
        name: '',
        data: chartSeriesData
  
    }]
  });
}


//Menu 3
function grafica_dimension_municipalidad(data,promedio){

    var chartSeriesData = [];

    var chartCategory = [];
   $.each(data, function(key, value) {
             var series_name = this.nombre;
             var series_data = this.porcentaje;
                           
          var series = [
                    series_name,
                    parseFloat(series_data)
                       ];
             chartSeriesData.push(series);   


        });
    //console.log(chartSeriesData);
  Highcharts.chart('container_dimension_municipalidad', {
    chart: {
        type: 'column'
           
         
         
    },
    title: {
        text: 'Porcentaje Dimensión por municipalidad'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        title: {
            text: 'Municipalidades'
        },
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        max:100,
        visible: true,
        title: {
            text: 'Porcentaje (%)'
        },
        maxPadding:0.1,
        plotLines: [{
      
        color: ((promedio == "0") ?"":'red'),
        value: promedio, 
        width: '1',
        zIndex: 2,
                  
       }]
       
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Porcentaje: <b>{point.y}</b>'+ " " + ' Promedio: <b>' + promedio.toFixed(2) + '</b>',

    },

    plotOptions: {
        column: {
            dataLabels: {
                enabled: true,
                 y: -20,
                verticalAlign: 'bottom'
            }
        }
    },

    series: [{
        name: 'Municipalidades',
         data:chartSeriesData,
          
        dataLabels: {
           
            enabled: true,
            rotation: -90,
            color: '#262626',
            align: 'right',
            format: '{point.y:.0f} %', // one decimal
           /* y: -25, // 10 pixels down from the top*/
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            },
           
            crop: false,
            overflow: 'none',
        }
      }]
   
  });

}


//Menu 4
function grafica_porcentaje_factor(data,prom)
{

     var chartSeriesData = [];

    var chartCategory = [];
   $.each(data, function(key, value) {
             var series_name = this.nombre;
             var series_data = this.promedio;
                           
          var series = [
                    series_name,
                    parseFloat(series_data)
                       ];
             chartSeriesData.push(series);   
             chartCategory.push(series_name);   

        });


  Highcharts.chart('container_cumplimiento_factor', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Porcentaje de cumplimiento por factor nivel nacional'
    },
    xAxis: {    
        categories: chartCategory,
        title: {
            text: 'Factores'
        }
    },
    yAxis: {
        min: 0,
        max:100,
        title: {
            text: 'Porcentaje'
        }
    },
    legend: {
        reversed: false
    },
         
    tooltip: {
        pointFormat: 'Porcentaje: <b>{point.y:.2f}</b>',

    },
      plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                formatter:function() {
                    return this.point.y.toFixed(2) + '%';
                }
            }
        }
    },

    series: [{
        name: '',
        data: chartSeriesData
  
    }]
  });


}

//Menu 5
function grafica_porcentaje_factormunicipalidad(data,promedio)
{

   var chartSeriesData = [];

    var chartCategory = [];
   $.each(data, function(key, value) {
             var series_name = this.nombre;
             var series_data = this.porcentaje;
                           
          var series = [
                    series_name,
                    parseFloat(series_data)
                       ];
             chartSeriesData.push(series);   


        });

  Highcharts.chart('container_factor_municipalidad', {
    chart: {
        type: 'column',
         
    },
    title: {
        text: 'Porcentaje factor por municipalidad'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        title: {
            text: 'Municipalidades'
        },
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        max:100,
        visible: true,
        title: {
            text: 'Porcentaje (%)'
        },
      
        plotLines: [{
      
        color: ((promedio == "0") ?"":'red'),
        value: promedio, 
        width: '1',
        zIndex: 2,
         tooltip: {
            pointFormat: '<span style="font-weight: bold;">'+ promedio.toFixed(2) +'</b>',
        }


                  
       }]
       
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Porcentaje: <b>{point.y}</b>'+ " " + ' Promedio: <b>' + promedio.toFixed(2) + '</b>',

    },

    series: [{
        name: 'Municipalidades',
         data:chartSeriesData,

          
        dataLabels: {
           
            enabled: true,
            rotation: -90,
            color: '#262626',
            align: 'right',
            format: '{point.y:.0f} %', // one decimal
            y: -20, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            },
            crop: false,
            overflow: 'none'
        }
      }]
   
  });


}