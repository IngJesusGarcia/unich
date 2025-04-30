   window.onload = function () {
                var dataLength = 0;
                var data = [];
                var data2 = [];
                $.getJSON("api/entradagrafica.php", function (result) {
                    dataLength = result.length;

                    for (var i = 0; i < dataLength; i++) {
                        data.push({
                            x: new Date(result[i].valorx),
                            y: parseInt(result[i].valory)
                        });
                    }
                    ;
                    console.log(data);
                    chart.render();
                     
                });

                 $.getJSON("api/entradagrafica2.php", function (result) {
                    dataLength = result.length;

                    for (var i = 0; i < dataLength; i++) {
                        data2.push({
                            x: new Date(result[i].valorx),
                            y: parseInt(result[i].valory)
                        });
                    }
                    ;
                   
                    chart2.render();
                     
                });

                //  $.getJSON("api/entradagrafica3.php", function (result) {
                //     dataLength = result.length;

                //     for (var i = 0; i < dataLength; i++) {
                //         data2.push({
                //             x: new Date(result[i].valorx),
                //             y: parseInt(result[i].valory)
                //         });
                //     }
                //     ;
                   
                   
                //       chart3.render();
                     
                // });




    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
      text: "Total de productos"
      },
       data: [{ type: "line", dataPoints: data}],
    });


   var chart2 = new CanvasJS.Chart("chartContainer2",
    {
      title:{
      text: "Salida de productos"
      },
       data: [{ type: "line", dataPoints: data2}],
    });

  //  var chart3 = new CanvasJS.Chart("chartContainer3",
  // {
  //   animationEnabled: true,
  //       theme: "theme2",
  //   title:{
  //     text: "Multi Series Spline Chart - Hide / Unhide via Legend"
  //   },
  //       axisY:[{
  //         lineColor: "#4F81BC",
  //         tickColor: "#4F81BC",
  //         labelFontColor: "#4F81BC",
  //         titleFontColor: "#4F81BC",
  //         lineThickness: 2,
  //       },
  //       {
  //         lineColor: "#C0504E",
  //         tickColor: "#C0504E",
  //         labelFontColor: "#C0504E",
  //         titleFontColor: "#C0504E",
  //         lineThickness: 2,
          
  //       }],
  //   data: [
  //   {
  //     type: "spline", //change type to bar, line, area, pie, etc
  //     showInLegend: true,        
  //     dataPoints: [
  //       { x: new Date(2008, 29), y: 50.00 },
  //       { x: new Date(2008, 05), y: 15.00 },
  //             { x: new Date(2008, 01), y: 100.00 },
        
  //     ]
  //     },
  //     {
  //     type: "spline",
  //                       axisYIndex: 1,
  //     showInLegend: true,            
  //     dataPoints: [
  //       { x: new Date(2008, 29), y: 50.00 },
  //       { x: new Date(2008, 05), y: 15.00 },
  //             { x: new Date(2008, 01), y: 100.00 },
  //     ]
  //     }
  //   ],
  //   legend: {
  //     cursor: "pointer",
  //     itemclick: function (e) {
  //       if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
  //         e.dataSeries.visible = false;
  //       } else {
  //         e.dataSeries.visible = true;
  //     }
     
  //     }
  //   }
  // });



    
  }

