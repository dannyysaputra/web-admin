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
    <!-- Daily Performance table -->
    <section class="grid">
        <!-- user profile -->
        <div class="">
            <div class="p-2 bg-secondary">
                <div class="d-flex">
                    <img src="/assets/image.jpg" class="me-3" style="width: 150px; height: 150px;" alt="Photo Profile">
                    <div>
                        <span class="d-block text-white text-uppercase">Danny Suggi Saputra</span>
                        <span class="d-block text-white">dannysaputra3003@gmail.com</span>
                    </div>
                </div>
                <button class="mt-3 w-100 d-block btn btn-primary">10 notifications</button>
                <button class="mt-3 w-100 d-block btn btn-success">50 inbox</button>
                <button class="mt-5 w-100 d-block btn btn-danger text-uppercase" data-bs-toggle="modal" data-bs-target="#myModal" type="button">Exit</button>
            </div>
        </div>
        <!-- modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Exit an application</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure want to exit an application
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="yes-exit" data-bs-dismiss="modal">Sure!</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- charts -->
        <div class="">
            <div class="running-text-container">
                <div class="scroll-text" style="color: brown;">Assisting Your Business From The Heart :: 03 Agustus 2018 Gathering</div>
            </div>
            <div class="border p-2 border-3 border-danger">
                <header class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button id="column-chart-btn" class="btn btn-outline-danger active text-uppercase">Column</button>
                        <button id="pie-chart-btn" class="btn btn-outline-danger text-uppercase">Pie</button>
                    </div>
                    <span class="text-uppercase" style="color: brown;">daily summary performance</span>
                </header>
                <div class="mt-3 p-2 border border-3 border-danger">
                    <div id="daily-column-chart" style="width: 100%; height: 400px"></div>
                    <div id="daily-pie-chart" style="width: 100%; height: 400px" class="d-none"></div>
                </div>
            </div>
        </div>
        <!-- table -->
        <div class="">
            <div class="">
                <div style="color: white;">Assisting Your Business From The Heart :: 03 Agustus 2018 Gathering</div>
            </div>
            <div class="border border-3 border-danger p-2">
                <div class="d-flex justify-content-end">
                    <span class="text-uppercase" style="color: brown;">daily summary performance</span>
                    <!-- TODO: add icon -->
                </div>
                <div class="mt-3">
                    <table id="daily-table" class="display" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>DAY</th>
                                <th>TARGET TIME (HOUR)</th>
                                <th>WORK TIME (HOUR)</th>
                                <th>ACHIEVEMENT (PERECENTAGE)</th>
                                <th>OVERTIME (HOUR)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="height: 100%;"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Year Summary Performance Table -->
    <section class="container-fluid border border-danger border-3 p-2">
        <!-- filter -->
        <header class="px-2 pt-2">
            <form action="index.php" method="POST" class="d-flex flex-row mb-3">
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
                    <span class="fw-bold text-uppercase" style="color: brown;">year summary performance</span>
                </div>
            </form>
        </header>
        <!-- table -->
        <table id="year-table" class="display px-2" data-start="<?php echo isset($_POST['start']) ? $_POST['start'] : 1 ?>" data-end="<?php echo isset($_POST['end']) ? $_POST['end'] : 31 ?>">
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
    </section>

    <!-- Charts -->
    <section class="container-fluid border border-danger border-3 mt-5 p-2">
        <header class="d-flex flex-row-reverse py-2">
            <span style="font-weight: bold; color: brown;">YEAR SUMMARY PERFORMANCE</span>
        </header>
        <div class="chart grid-3 row gx-3 pb-2">
            <!-- column chart -->
            <div class="col">
                <h4 class="border border-3 border-secondary">Column</h4>
                <div id="year-column-chart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
            <!-- pie chart -->
            <div class="col">
                <h4 class="border border-3 border-secondary">Pie</h4>
                <div id="year-pie-chart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
            <!-- area chart -->
            <div class="col">
                <h4 class="border border-3 border-secondary">Area</h4>
                <div id="year-area-chart" style="width: 100%; height: 480px" class="border border-3 border-secondary"></div>
            </div>
        </div>
    </section>

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