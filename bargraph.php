<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="include/jsapi"></script>
    <script type="text/javascript" src="include/jquery.min.js"></script>
    <script type="text/javascript">

    
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function displayGraph(){
    var station = document.getElementById('myStation').value;
    

    var content = document.getElementById("content");
    document.getElementById("body").innerHTML = "";
    document.getElementById("body").appendChild(content);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "getData.php?&station="+station,
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 400, height: 240});
    }
    drawChart();
  }

    </script>
  <body id="body">
<div id="content">
<form action ="" method ="POST">
        <td>
        Enter Station ID: <input type="text" name="station" id="myStation"> 
        </td>
        <td valign="top">
        <input type="button" class="action" onclick="displayGraph();" value="Display Graph" />
        </td>
</tr>

</form>
<div id="chart_div"></div>
</div>

</body>
</html>