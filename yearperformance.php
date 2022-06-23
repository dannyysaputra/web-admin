<section class="container-fluid border border-danger border-3 mt-5 p-2">
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
                    <!-- <input class="btn btn-secondary" id="clear-year-filter" value="Clear" type="button"> -->
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