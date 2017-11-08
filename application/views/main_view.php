<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестове</title>



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Time', 'Перший', 'Другий'],
          ['2',  1000,      400],
          ['4',  1170,      460],
          ['6',  660,       1120],
          ['8',  1030,      540]
        ]);

        var options = {
          hAxis: {
            title: 'Проміжок часу'
          },
          vAxis: {
            title: 'Сума'
          },
          colors: ['#a52714', '#097138'],
          width: 900,
          height: 400
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart'));

        chart.draw(data, options);
      }

    </script>



</head>

<body>

    <p>Графік</p>
    <div>
        <?= $arr[0]['id'] ?>
    </div>

    <div id="chart"></div>

</body>

</html>