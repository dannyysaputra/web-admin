document.addEventListener('DOMContentLoaded', function () {

    // modal exit
    $('#yes-exit').click(function() {
        alert('You have exited.');
    })

    // change chart event
    $('#column-chart-btn').click(function() {
        $('#daily-column-chart').removeClass('d-none');
        $('#daily-pie-chart').addClass('d-none');
        $(this).addClass('active');
        $('#pie-chart-btn').removeClass('active');
    })
    $('#pie-chart-btn').click(function() {
        $('#daily-pie-chart').removeClass('d-none');
        $('#daily-column-chart').addClass('d-none');
        $(this).addClass('active');
        $('#column-chart-btn').removeClass('active');
    })
    
    // daily data table
    const dailyTable = $('#daily-table');
    const dailyDataTable = dailyTable.DataTable({
        fnInitComplete: function (oSettings, json) {
            renderDailyColumnChart(json);
            renderDailyPieChart(json);
        },
        pageLength: 5,
        lengthMenu: [5, 10, 15, 20],
        ajax: {
            url: '/api/dailyperformances.json',
            dataSrc: ''
        },
        columns: [{
            data: 'date'
        },
        {
            data: 'target_time'
        },
        {
            data: 'work_time'
        },
        {
            data: 'achievement'
        },
        {
            data: 'overtime'
        },
        {
            data: 'day'
        }
    ]
    })

    // daily column chart
    const renderDailyColumnChart = async (d) => {
        const data = await getDataFromJson(d);
        var chart = {
            type: 'column'
        };
        var title = {
            text: 'Daily Summary of Target Time, Working Time Comparison with Overtime'
        };
        var xAxis = {
            categories: data.categories,
            crosshair: true
        };
        var yAxis = {
            min: 0,
            max: 24,
            title: {
                text: 'Time (hour)'
            }
        };
        var tooltip = {
            headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}: </td>' +
                '<td style = "padding:0"><b>{point.y:.1f} hour</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        };
        var plotOptions = {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            onClickSeries(this.id, 'year-table');
                        }
                    }
                }
            },
            coloumn: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        };
        var credits = {
            enabled: false
        };
        var series = [{
                name: 'Target Time',
                data: data.targetTimes
            },
            {
                name: 'Work Time',
                data: data.workTimes
            },
            {
                name: 'Overtime',
                data: data.overTimes
            }
        ]
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.series = series;
        json.plotOptions = plotOptions;
        json.credits = credits;
        $('#daily-column-chart').highcharts(json);
    }

    // daily pie chart
    const renderDailyPieChart = async (d) => {
        const data = await getDataFromJson(d);
        var chart = {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        };
        var title = {
            text: 'Daily Summary Achievement'
        };
        var tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        };
        var plotOptions = {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) ||
                            'black'
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            onClickSeries(this.id, 'daily-table')
                        }
                    }
                }
            }
        };
        var series = [{
            type: 'pie',
            name: 'Achievement',
            data: data.achievements
        }];
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.series = series;
        json.plotOptions = plotOptions;
        $('#daily-pie-chart').highcharts(json);
    }

    // date picker
    var $select = $('.date');
    for (i = 1; i <= 31; i++) {
        $select.append($('<option></option>').val(i).html(i));
    }

    // year data table
    const yearTable = $('#year-table');
    const yearDataTable = yearTable.DataTable({
        fnInitComplete: function (oSettings, json) {
            const startDate = yearTable.data('start');
            const endDate = yearTable.data('end');

            const filterDataTable = json.filter(data => {
                return data.date >= startDate && data.date <= endDate;
            });

            yearDataTable.clear();
            yearDataTable.rows.add(filterDataTable);
            yearDataTable.draw();
        },
        ajax: {
            url: '/api/yearperformances.json',
            dataSrc: ''
        },
        columns: [{
                data: 'date'
            },
            {
                data: 'target_time'
            },
            {
                data: 'work_time'
            },
            {
                data: 'achievement'
            },
            {
                data: 'overtime'
            },
            {
                data: 'day'
            }
        ]
    });

    const getDataFromJson = (data) => {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                const targetTimes = [];
                const workTimes = [];
                const overTimes = [];
                const categories = [];
                const achievements = [];

                data.map((data) => {
                    categories.push(`Day ${data.date}`);
                    targetTimes.push({y: Number(data.target_time), id: data.id});
                    workTimes.push({y: Number(data.work_time), id: data.id});
                    overTimes.push({y: Number(data.overtime), id: data.id});
                    achievements.push({name: `Day ${data.date}`, y: Number(data.achievement), id: data.id});
                })

                resolve({
                    categories,
                    targetTimes,
                    workTimes,
                    overTimes,
                    achievements
                })
            }, 2000)
        })
    }

    // click impact other charts
    const onClickSeries = (id, type) => {
        var dataSeries;
        var table = type === 'year-table' ? yearDataTable : dailyDataTable;

        table.data().map((d) => {
            if (d.id === id) dataSeries = d;
        });

        table.clear();
        table.rows.add([dataSeries]);
        table.draw();

        if (type === 'year-table') {
            renderYearColumnChart([dataSeries]);
            renderYearPieChart([dataSeries]);
            renderYearAreaChart([dataSeries]);
        } else {
            renderDailyColumnChart([dataSeries]);
            renderDailyPieChart([dataSeries]);
        }
    }

    // column chart
    const renderYearColumnChart = async (d) => {
        const data = await getDataFromJson(d);
        var chart = {
            type: 'column'
        };
        var title = {
            text: 'Year Summary of Target Time, Working Time Comparison with Overtime'
        };
        var xAxis = {
            categories: data.categories,
            crosshair: true
        };
        var yAxis = {
            min: 0,
            max: 24,
            title: {
                text: 'Time (hour)'
            }
        };
        var tooltip = {
            headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}: </td>' +
                '<td style = "padding:0"><b>{point.y:.1f} hour</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        };
        var plotOptions = {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            onClickSeries(this.id, 'year-table');
                        }
                    }
                }
            },
            coloumn: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        };
        var credits = {
            enabled: false
        };
        var series = [{
                name: 'Target Time',
                data: data.targetTimes
            },
            {
                name: 'Work Time',
                data: data.workTimes
            },
            {
                name: 'Overtime',
                data: data.overTimes
            }
        ]
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.series = series;
        json.plotOptions = plotOptions;
        json.credits = credits;
        $('#year-column-chart').highcharts(json);
    }
    setTimeout(() => {
        renderYearColumnChart(yearDataTable.data());
    }, 1000)

    // pie chart
    const renderYearPieChart = async (d) => {
        const data = await getDataFromJson(d);
        var chart = {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        };
        var title = {
            text: 'Year Summary Achievement'
        };
        var tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        };
        var plotOptions = {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) ||
                            'black'
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            onClickSeries(this.id, 'year-table')
                        }
                    }
                }
            }
        };
        var series = [{
            type: 'pie',
            name: 'Achievement',
            data: data.achievements
        }];
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.series = series;
        json.plotOptions = plotOptions;
        $('#year-pie-chart').highcharts(json);
    }
    setTimeout(() => {
        renderYearPieChart(yearDataTable.data());
    }, 1000)

    // area chart
    const renderYearAreaChart = async (d) => {
        const data = await getDataFromJson(d);
        var chart = {
            type: 'area'
        };
        var title = {
            text: 'Year Summary of Target Time Comparison with Working Time'
        };
        var xAxis = {
            categories: data.categories
        };
        var yAxis = {
            min: 0,
            max: 24,
            title: {
                text: 'Time (hour)'
            }
        };
        var tooltip = {
            pointFormat: '{series.name} achieved <b>{point.y:,.0f}</b><br/>hours'
        };
        var plotOptions = {
            area: {
                marker: {
                    enabled: true,
                    symbol: 'circle',
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            onClickSeries(this.id, 'year-table')
                        }
                    }
                }
            }
        };
        var series = [{
                name: 'Target Time',
                data: data.targetTimes
            },
            {
                name: 'Work Time',
                data: data.workTimes
            }
        ];
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.series = series;
        json.plotOptions = plotOptions;
        $('#year-area-chart').highcharts(json);
    }
    setTimeout(() => {
        renderYearAreaChart(yearDataTable.data());
    }, 1000)

    // search table impact to chart
    $('.dataTables_filter input').unbind().keyup(function () {
        const value = $(this).val();
        const result = yearDataTable.search(value).rows({
            search: 'applied'
        });

        result.map(datas => {
            const searchData = [];
            datas.map(data => [
                searchData.push(yearDataTable.data()[data])
            ]);

            renderYearAreaChart(searchData);
            renderYearColumnChart(searchData);
            renderYearPieChart(searchData);
        });

        yearDataTable.draw();
    })
})