<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    @vite('resources/css/app.css')


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.blocks.nav')
        @include('admin.blocks.sidebar')
        {{-- main content --}}
        <div class="content-wrapper">
            @if (session('msg'))
                <h3>{{ session('msg') }}</h3>
            @endif
            <div class="contentDash">
                <div class="turnover childrenContent">
                    <div class="wrapBoxChil">
                        <div class="">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <span>{{ $totalPrice }}</span>
                        <span>
                            <p>Tổng doanh thu</p>
                        </span>
                    </div>
                </div>
                <div class="grossProduct childrenContent">
                    <div class="wrapBoxChil">
                        <div class="">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <span>{{ $count }}</span>
                        <span>
                            <p>Tổng số sản phẩm</p>
                        </span>
                    </div>
                </div>
                <div class="customer childrenContent">
                    <div class="wrapBoxChil">
                        <div class="">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <span>{{ $countCustomer }} </span>
                        <span>
                            <p>Tổng số khách hàng</p>
                        </span>
                    </div>
                </div>
            </div>
            {{-- chartjs --}}
            <div class="chartBar">
                <div class="tableMyChart">
                    <h2 style="color: #2f9d77; margin-top: 1rem;">Thống kê giá sản phẩm</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>thông số</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>cvvxcv</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="wrapperChart ">
                    <h3>Biểu đồ tổng số sản phẩm theo danh mục</h3>
                    <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>


        {{-- footer --}}
        @include('admin.blocks.footer')

    </div>
    @include('sweetalert::alert')

</body>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>


<script>
    const labels = {!! json_encode($data[0]) !!};
    const dataValues = {!! json_encode($data[1]) !!};

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sản phẩm',
                data: dataValues,
                backgroundColor: [
                    '#C4E4E9',
                ],
                borderColor: [
                    // 'rgba(255, 99, 132, 1)',
                    // 'rgba(54, 162, 235, 1)',
                    // 'rgba(255, 206, 86, 1)',
                    // 'rgba(75, 192, 192, 1)',
                    // 'rgba(153, 102, 255, 1)',
                    // 'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16
                        }
                    }
                }
            }
        }
    });
</script>

</html>
