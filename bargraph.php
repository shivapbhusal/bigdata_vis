<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="include/jsapi"></script>
    <script type="text/javascript" src="include/jquery.min.js"></script>
    <script type="text/javascript">

    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "getData.php",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 400, height: 240});
    }

    </script>
  <body id="body">
<div id="content">
<form action ="" method ="POST">
<tr id="tableRow">
        <th valign="bottom">Select country:</th>
        <td >   
        <select name="country" id="myCountry" class="">
            
               <option value = "AFG">Afganistan</option>
               <option value = "ALB">Albania</option>
               


            </select>
            
        </td>
        
            
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