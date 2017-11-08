<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестове завдання</title>

    <link rel = "stylesheet" href = "<?php echo base_url(); ?>css/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      window.onload =function() {

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable(<?= $arr ?>);

          var options = {
            hAxis: {
              title: '<?= $x ?>'
            },
            vAxis: {
              title: '<?= $y ?>'
            }
          };

          var chart = new google.visualization.LineChart(document.getElementById('chart'));
          chart.draw(data, options);
        }

      };
    </script>

</head>

<body>
    <h1>Графік</h1>
    <p class="info">З <span><?= $start ?></span> по <span><?= $stop ?></span> крок <span><?= $step ?></span></p>
    <div class="center" id="chart"></div>
</body>

</html>
