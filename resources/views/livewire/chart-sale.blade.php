<div>
<div x-data="{ chart: null }" x-init="">
  <h1>Jumlah Yuran Bulanan & Elaun Guru</h1>
  <hr>

  <div class="m-auto">
<div class="">
        <label for="year">Select Year:</label>
 <select id="yearSelect" onchange="updateChart()">
        <option value="">select year</option>
       <option value="2022">2022</option>
       <option value="2023">2023</option>
</select>
    </div>

                         <div class="col-lg-10">
                          <div class="card text-grey bg-white rounded-3 shadow p-1">
                            <div class="body">
                            <canvas id="myChart" class="chartjs" data-height="400" height="500" style="display: block; box-sizing: border-box; height: 400px; width: 592.8px;" width="741"></canvas>
                            </div>

                          </div>

                      </div>
                      </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>

var feejan22 = <?php echo $reportclasses->where('month',null)->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feefeb22 = <?php echo $reportclasses->where('month','02-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feemar22 = <?php echo $reportclasses->where('month','03-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feeapr22 = <?php echo $reportclasses->where('month','04-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feemay22 = <?php echo $reportclasses->where('month','05-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feejun22 = <?php echo $reportclasses->where('month','06-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feejul22 = <?php echo $reportclasses->where('month','07-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feeogs22 = <?php echo $reportclasses->where('month','08-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feesep22 = <?php echo $reportclasses->where('month','09-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feeoct22 = <?php echo $reportclasses->where('month','10-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feenov22 = <?php echo $reportclasses->where('month','11-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feedec22 = <?php echo $reportclasses->where('month','12-2022')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feejan23 = <?php echo $reportclasses->where('month','01-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feefeb23 = <?php echo $reportclasses->where('month','02-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feemar23 = <?php echo $reportclasses->where('month','03-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feeapr23 = <?php echo $reportclasses->where('month','04-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feemay23 = <?php echo $reportclasses->where('month','05-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feejun23 = <?php echo $reportclasses->where('month','06-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feejul23 = <?php echo $reportclasses->where('month','07-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feeogs23 = <?php echo $reportclasses->where('month','08-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feesep23 = <?php echo $reportclasses->where('month','09-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;
var feeoct23 = <?php echo $reportclasses->where('month','10-2023')->whereNull('deleted_at')->sum('fee_student') ?? ''; ?>;

var alwjan22 = <?php echo $reportclasses->where('month',null)->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwfeb22 = <?php echo $reportclasses->where('month','02-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmar22 = <?php echo $reportclasses->where('month','03-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwapr22 = <?php echo $reportclasses->where('month','04-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmay22 = <?php echo $reportclasses->where('month','05-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjun22 = <?php echo $reportclasses->where('month','06-2022')->whereNull('deleted_at')->sum('allowance') ?? ''?>;
var alwjul22 = <?php echo $reportclasses->where('month','07-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwogs22 = <?php echo $reportclasses->where('month','08-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwsep22 = <?php echo $reportclasses->where('month','09-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwoct22 = <?php echo $reportclasses->where('month','10-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwnov22 = <?php echo $reportclasses->where('month','11-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwdec22 = <?php echo $reportclasses->where('month','12-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjan23 = <?php echo $reportclasses->where('month','01-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwfeb23 = <?php echo $reportclasses->where('month','02-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmar23 = <?php echo $reportclasses->where('month','03-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwapr23 = <?php echo $reportclasses->where('month','04-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmay23 = <?php echo $reportclasses->where('month','05-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjun23 = <?php echo $reportclasses->where('month','06-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjul23 = <?php echo $reportclasses->where('month','07-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwogs23 = <?php echo $reportclasses->where('month','08-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwsep23 = <?php echo $reportclasses->where('month','09-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwoct23 = <?php echo $reportclasses->where('month','10-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;

// Define the chart data and options

var chartData = {
    labels: ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november','december'],
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: 'rgba(0,0,255,1.0)',
      borderColor: 'rgba(0,0,255,0.1)',
      data: [],
      label: 'Total Fees(RM)',
    }, {
      fill: false,
      lineTension: 0,
      backgroundColor: 'rgba(255, 99, 71, 1)',
      borderColor: 'rgba(255, 108, 49, 0.3)',
      data: [],
      label: 'Total Allowance(RM)',
    }]
  };

  var chartOptions = {
    maintainAspectRatio: false,
    legend: {
      display: true,
    },
    scales: {
      yAxes: [{ ticks: { min: 0, max: 50000 } }],
    }
  };

  // Create an empty chart instance
  var chart = new Chart(document.getElementById('myChart'), {
    type: 'line',
    data: chartData,
    options: chartOptions
  });

  // Function to update the chart based on the selected year
  function updateChart() {
    var selectedYear = document.getElementById('yearSelect').value;
    var feeData = [];
    var allowanceData = [];

    // Retrieve the data for the selected year
    switch (selectedYear) {
      case '2022':
        feeData = [feejan22,feefeb22,feemar22, feeapr22, feemay22, feejun22, feejul22, feeogs22, feesep22, feeoct22, feenov22, feedec22];
        allowanceData = [alwjan22,alwfeb22,alwmar22, alwapr22, alwmay22, alwjun22, alwjul22, alwogs22, alwsep22, alwoct22, alwnov22, alwdec22];
        break;
      case '2023':
        feeData =[feejan23,feefeb23,feemar23,feeapr23,feemay23,feejun23,feejul23,feeogs23,feesep23,feeoct23];
        allowanceData =[alwjan23,alwfeb23,alwmar23,alwapr23,alwmay23,alwjun23,alwjul23,alwogs23,alwsep23,alwoct23];
        break;
      default:
        // Handle default case or show an error message
        break;
    }

    // Update the chart data
    chart.data.datasets[0].data = feeData;
    chart.data.datasets[1].data = allowanceData;
    chart.update();
  }

</script>

</div>
