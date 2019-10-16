 <!-- jQuery -->
    
 

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js' type='text/javascript'></script>

       <script src="js/script.js"></script>
       <script>

            Dropzone.autoDiscover = false;

            var myDropzone = new Dropzone(".dropzone", { 
               autoProcessQueue: false,
               parallelUploads: 10 // Number of files process at a time (default 2)
            });

            $('#uploadfiles').click(function(){
               myDropzone.processQueue();
            });

        </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Photos',     <?php echo Photo::count_all(); ?>],
          ['Views',      <?php echo $_SESSION['counts']; ?>],
          ['Users',  <?php echo User::count_all(); ?>],
          ['Comments', <?php echo Comment::count_all(); ?>]
        ]);

        var options = {
          title: 'Visualization of all data',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

</body>

</html>
