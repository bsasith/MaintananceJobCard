$(function () {
    $.ajax({
        url: 'http://localhost/MaintananceJobCard/PUser/chart_data.php',
        type: 'GET',
        dataType: 'json', // Ensures the response is treated as JSON
        success: function (data) {
            // `data` will already be a parsed JSON object because of dataType: 'json'
            var chartProperties = {
                "caption": "Total down time This month in Hours for Each Factory",
                "xAxisName": "Hours",
                "yAxisName": "Factory",
                "rotatevalues": "1",
                "theme": "zune"
            };

            var apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '1000',
                height: '500',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": data, // `data` is already a JSON object
                    "trendlines": [{
                        "line": [{
                            "startvalue": "12",
                            "color": "#1aaf5d",
                            "thickness": "4",
                            "displayvalue": "Target",
                            "dashed": "1",
                            "dashLen": "4",
                            "dashGap": "2"
                        }]
                    }]
                }
            });
            apiChart.render();
        },
        error: function (xhr, status, error) {
            console.error("Error occurred: " + status + " " + error);
        }
    });
});
