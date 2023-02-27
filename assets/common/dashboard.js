// document.addEventListener('mousewheel', alert(1), {capture: true});
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "" ;
}
function setDataChart(data){
	const array = Object.values(data);
	const key_data = Object.keys(data);
	let series = [];
	const line_date = array[0]['date'];

	for (var i = 0; i < array.length; i++) {
		let line = array[i];
		line_transaction = line.transaction;
		series.push({name:key_data[i], type:'line', data:line_transaction});
	}
	data_chart = {series:series,key_data:key_data,line_date:line_date};
	return data_chart;

}
function transactionLines(axis_x,series,legend){
	$(function() {
	    // Set paths
	    // ------------------------------
	    require.config({
	        paths: {
	            echarts: 'assets/js/plugins/visualization/echarts'
	        }
	    });
	    // Configuration
	    // ------------------------------
	    require(
	        [
	            'echarts',
	            'echarts/theme/limitless',
	            'echarts/chart/bar',
	            'echarts/chart/line'
	        ],

	        // Charts setup
	        function (ec, limitless) {
	            // Initialize charts
	            // ------------------------------
	            var basic_lines = ec.init(document.getElementById('basic_lines'), limitless);
	            var colors = ['#66BB6A','#5793f3', '#d14a61'];
	            // Basic lines options
	            //
	            basic_lines_options = {

	            	color: colors,
	            	tooltip: {
				        trigger: 'axis',
				        axisPointer: {
				            type: 'cross'
				        }
				    },

	                // Add legend
	                legend: {
	                    data: legend
	                },

	                // Add custom colors
	                // color: ['#EF5350', '#66BB6A'],

	                // Horizontal axis
	                xAxis: [{
	                    type: 'category',
	                    boundaryGap: false,
	                    axisTick: {
			                alignWithLabel: true
			            },
	                    data: axis_x
	                }],

	                calculable: false,
	                // Vertical axis
	                yAxis: [
				        {
				            type: 'value'
				        }
				    ],

	                // Add series
	                series: series
	            };

	            // Apply options
	            // ------------------------------
	            basic_lines.setOption(basic_lines_options);

	            // Resize charts
	            // ------------------------------
	            window.onresize = function () {
	                setTimeout(function () {
	                    basic_lines.resize();
	                }, 200);
	            }
	        }
	    );
	});
}

function ticket_chart(data,legend)
{	
	unselected_legend = {};
	for (var i = 0; i < data.length; i++) {
		if (data[i].value == 0){
			unselected_legend[data[i].name]= false;
		};
	}
	$(function () {

	    // Set paths
	    // ------------------------------
	    require.config({
	        paths: {
	            echarts: 'assets/js/plugins/visualization/echarts'
	        }
	    });

	    // Configuration
	    // ------------------------------
	    require(
	        [
	            'echarts',
	            'echarts/theme/limitless',
	            'echarts/chart/pie',
	            'echarts/chart/funnel'
	        ],

	        // Charts setup
	        function (ec, limitless) {

	            // Initialize charts
	            // ------------------------------
	            var basic_pie = ec.init(document.getElementById('basic_pie'), limitless);           

	            // Charts setup
	            // ------------------------------                    

	            // Basic pie options
	            //

	            basic_pie_options = {

	                // Add title
	                title: {
	                    // text: 'Ticket Popularity',
	                    // subtext: 'most pick ticket',
	                    // x: 'center'
	                },

	                // Add tooltip
	                tooltip: {
	                    trigger: 'item',
	                    formatter: "{a} <br/>{b}: {c} ({d}%)"
	                },

	                // Add legend
	                legend: {
	                    orient: 'vertical',
	                    x: 'left',
	        			//right: 10,
				        // top: 20,
				        // bottom: 20,
	                    formatter: function (name) {
						    let itemValue = data.filter(item => item.name === name);
    						return name + ' : ' + itemValue[0].value;
						    // return data.value + name;
						},
						// selected: {'Parkir Atas R4':true},
						selected: unselected_legend,
	                    data: legend
	                },

	                // Enable drag recalculate
	                calculable: false,

	                // Add series
	                series: [{
	                    name: 'Ticket category',
	                    type: 'pie',
	                    radius: '50%',
	                    center: ['60%', '50%'],
	                    data: data,
	                    itemStyle: {
			                emphasis: {
			                    shadowBlur: 10,
			                    shadowOffsetX: 0,
			                    shadowColor: 'rgba(0, 0, 0, 0.5)'
			                }
           				 }
	                }]
	            };

	            // Apply options
	            // ------------------------------
	            basic_pie.setOption(basic_pie_options);

	            window.onresize = function () {
	                setTimeout(function (){
	                    basic_pie.resize();
	                }, 200);
	            }
	        }
	    );
	});	
}
