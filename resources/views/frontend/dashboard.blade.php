@extends('frontend.master')
@section('content')
    <div class="flex items-center justify-between">
        <span class="mb-4 t xt-3xl font-extrabold text-gray-900 dark:text-black md:text-5xl lg:text-6xl"><span
                class="text-transparent bg-clip-text bg-gradient-to-r to-amber-600 from-amber-400">Sumarry</span> Booking
            Data {{ $year }}

        </span>
        <div class="flex items-center ">

            <!-- Year Dropdown -->
            <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Select a Year
                </label>
                <select id="year" name="year"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
               dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    onchange="redirectToYearMonth()">



                    @foreach ($years_exist as $y)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    </div>




    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs-plugin-datalabels.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2"></script>



    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center bg-white mt-2 dark:bg-white " id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Booking by Year</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">...</button>
            </li>


            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab" data-tabs-target="#Company" type="button" role="tab" aria-controls="Company"
                    aria-selected="false">...</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                    aria-selected="false">...</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:white" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">

            <div class="grid grid-cols-2 gap-2">

                <script>
                    // Manual months array
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                </script>
                @foreach ($chartData as $room)
                    @php
                        $id = Str::slug($room['room'], '_');
                        $data = $room['data'] ?? [];

                    @endphp

                    <div class="mb-10">
                        <h2 class="font-bold text-lg mb-3">{{ $room['room'] }}</h2>
                        <canvas id="Chart_{{ $id }}" class="canvas_control2"></canvas>

                        <script>
                            console.log(@json($data));
                            const dataValues_{{ $id }} = Array.isArray(@json($data)) ? @json($data) :
                                [];
                            const maxValue_{{ $id }} = Math.max(...dataValues_{{ $id }});
                            const minValue_{{ $id }} = Math.min(...dataValues_{{ $id }});


                            const ctx_{{ $id }} = document.getElementById("Chart_{{ $id }}");



                            const chartData_{{ $id }} = {
                                labels: months,
                                datasets: [{
                                    type: 'line',
                                    label: 'Monthly Records',
                                    data: dataValues_{{ $id }},
                                    backgroundColor: "rgba(0,255,255,0.4)", // cyan bars
                                    borderColor: "cyan",
                                    borderWidth: 1,
                                    borderSkipped: false,
                                    borderRadius: 0,
                                    barPercentage: 0.6,
                                    categoryPercentage: 0.8,
                                    datalabels: {
                                        display: true,
                                        color: '#000',
                                        font: {
                                            weight: 'bold'
                                        },
                                        formatter: (value) => {
                                            return value; // Only show number on top
                                        }
                                    }
                                }]
                            };

                            new Chart(ctx_{{ $id }}, {
                                type: 'bar',
                                data: chartData_{{ $id }},
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grace: '20%'
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: (context) => {
                                                    const value = context.parsed.y;
                                                    return `${value} Booking`; // Show full text on hover
                                                }
                                            }
                                        },
                                        legend: {
                                            display: false
                                        }
                                    },
                                    interaction: {
                                        mode: 'nearest',
                                        axis: 'x',
                                        intersect: false
                                    }
                                },
                                plugins: [ChartDataLabels]
                            });
                        </script>
                    </div>
                @endforeach



            </div>









        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <div class="grid grid-cols-2 gap-2">
                Department Booking
                {{-- 📊 Department This Year --}}


            </div>







        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
            aria-labelledby="settings-tab">
            <div class="grid grid-cols-2">


            </div>
            <div class="grid grid-cols-1 mt-5">



            </div>





        </div>
        <div class="hidden p-0 rounded-lg bg-gray-50 dark:bg-gray-800" id="Company" role="tabpanel"
            aria-labelledby="Company">

            {{-- 📊 Company This Year --}}
            <div class="flex items-center justify-center">
                <canvas id="CompanyThisYear" class="canvas_control3"></canvas>
            </div>
            {{-- 📊 Department This Year --}}
            <div class="w-full flex items-center justify-center">

                <canvas id="ChartLast12Months_company" class="canvas_control4"></canvas>
            </div>



        </div>
    </div>
    </div>

    <script>
        function redirectToYearMonth() {
            const year = document.getElementById('year').value;

            if (year) {
                window.location.href = `/booking/dashboard/${year}`;
            }
        }
        const colors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];
        const borderColors = colors.map(c => c.replace('0.2', '1'));
    </script>
@endsection
