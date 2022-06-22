<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- JS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Data Tabel</title>
</head>

<body class="p-2">
    <div class="container-fluid border border-danger border-3 p-2">
        <form action="index.php" method="POST" class="px-2 pt-2">
            <div class="d-flex flex-row mb-3">
                <div class="form-group me-3 d-inline">
                    <label for="start">STARTDATE</label>
                    <div class="w-100"></div>
                    <select class="date" name="start" id="start"></select>
                </div>
                <div class="form-group me-4">
                    <label for="end">ENDDATE</label>
                    <div class="w-100"></div>
                    <select class="date" name="end" id="end"></select>
                </div>
                <div class="col">
                    <button class="btn btn-danger" type="submit">Reload</button>
                </div>
                <div class="flex-row">
                    <span style="font-weight: bold; color: brown;">YEAR SUMMARY PERFORMANCE</span>
                </div>
            </div>
        </form>
        <!-- table -->
        <table id="year-table"
            class="display px-2"
            data-start="<?php echo isset($_POST['start']) ? $_POST['start'] : 1?>" 
            data-end="<?php echo isset($_POST['end']) ? $_POST['end'] : 31?>">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>TARGET TIME (HOUR)</th>
                    <th>WORK TIME (HOUR)</th>
                    <th>ACHIEVEMENT (PERECENTAGE)</th>
                    <th>OVERTIME (HOUR)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="container-fluid border border-danger border-3 mt-5 p-2">
        <div class="d-flex flex-row-reverse py-2">
            <span style="font-weight: bold; color: brown;">YEAR SUMMARY PERFORMANCE</span>
        </div>
        <div class="chart grid-3 row gx-3 pb-2">
            <div class="col">
                <h4 class="border border-3 border-secondary">Column</h4>
                <div id="columnChart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
            <div class="col">
                <h4 class="border border-3 border-secondary">Pie</h4>
                <div id="pieChart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
            <div class="col">
                <h4 class="border border-3 border-secondary">Area</h4>
                <div id="areaChart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="js/app.js"></script>
</body>

</html>