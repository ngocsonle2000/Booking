@extends('layouts.admin_2')
@section('title', 'Dasboard')
@section('main')

    <div class="">

        <table class="row">
            <tr>
                <th class="col-md-2">Từ ngày: </th>
                <th class="col-md-2">Đến ngày: </th>
                <th class="col-md-4">Lọc theo: </th>
                <th class="col-md-3"></th>
            </tr>
            <tr>
                <form autocomplete="off" method="post">
                    @csrf
                    <td class="col-md-2">
                        <input type="date" class="form-control"  id="dateForm">
                    </td>
                    <td class="col-md-2">
                        <input type="date" class="form-control" id="dateTo">
                    </td>
                    <td class="col-md-4">
                        <select name="filter" id="" class="form-control filter-dasboard">
                            <option value="">Chọn</option>
                            <option value="seven-date">7 ngày qua</option>
                            <option value="last-month">Tháng trước</option>
                            <option value="this-month">Tháng này</option>
                            <option value="last-year">365 ngày qua</option>
                        </select>
                    </td>
                    <td class="col-md-3">
                        <button type="button" class="btn btn-primary " id="btn-filter">Lọc kết quả</button>
                    </td>
                </form>
            </tr>
        </table>
        <br>
        <div id="container"></div>
    </div>
@stop
@section('js')
    <script>
        // Create the chart
        var chartDT = Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: ''
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {

                pointFormat: ''
            },

            series: [{
                colorByPoint: true,
                data: [0]
            }],
        });
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                title: 'new',
                post: 'new post'
            })
        };
    </script>
    {{-- <script>
        fetch('http://localhost/Travel/user/dauthang')
            .then(response => response.json())
            .then(data => {
                var xValues = []
                var yValues = []
                data.forEach(e => {
                    //    console.log(e.name);
                    xValues.push(e.name);
                    yValues.push(e.count)
                })
                var barColors = ['rgba(54, 162, 235, 0.2)'];

                new Chart("myChart", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: ""
                        }
                    }
                });
            });
    </script> --}}
@stop
