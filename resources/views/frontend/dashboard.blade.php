@extends('frontend.master')
@section('content')
    <div class="flex items-center justify-between">
        <span class="mb-4 t xt-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span
                class="text-transparent bg-clip-text bg-gradient-to-r to-amber-600 from-amber-400">Sumarry</span> Booking
            Data {{ $year }}

        </span>
        <div class="flex items-center ">

            <!-- Year Dropdown -->
            <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Select a Year
                </label>
                <select id="year" name="year"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
               dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    onchange="redirectToYearMonth()">

                    @php
                        $currentYear = \Carbon\Carbon::now()->year;
                        $years = range($currentYear, $currentYear - 4); // Last 5 years
                    @endphp

                    @foreach ($years as $y)
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
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Room Booking</button>
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
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
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
                                datasets: [
                                    // Bar
                                    {
                                        type: 'bar',
                                        label: 'Monthly Records',
                                        data: dataValues_{{ $id }},
                                        backgroundColor: "rgba(0,255,255,0.4)", // cyan bars
                                        borderColor: "cyan", // optional border
                                        borderWidth: 1, // optional
                                        borderSkipped: false,
                                        borderRadius: 0,
                                        barPercentage: 0.6,
                                        categoryPercentage: 0.8,
                                        datalabels: {
                                            display: false
                                        }
                                    },
                                    // Trend line
                                    {
                                        type: 'line',
                                        label: 'Trend ' + year,
                                        data: dataValues_{{ $id }},
                                        borderColor: "cyan", // cyan line
                                        backgroundColor: "rgba(0,255,255,0.2)", // cyan fill under the line
                                        fill: true, // fill under the line
                                        tension: 0.4,
                                        pointRadius: 4,
                                        pointHoverRadius: 6,
                                        pointBackgroundColor: "cyan", // cyan points
                                        segment: {
                                            borderColor: "cyan", // make segments cyan
                                            borderWidth: 2
                                        }
                                    }
                                ]
                            };

                            new Chart(ctx_{{ $id }}, {
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
                                        datalabels: {
                                            align: 'top',
                                            anchor: 'end',
                                            color: '#000',
                                            font: {
                                                weight: 'bold'
                                            },
                                            formatter: (value, context) => {
                                                if (value === 0) return '';
                                                const index = context.dataIndex;
                                                if (index === 0) return value;
                                                const prev = context.dataset.data[index - 1];
                                                if (prev === 0) return value;
                                                const diff = value - prev;
                                                const percent = ((diff / prev) * 100).toFixed(1);
                                                const sign = percent > 0 ? '+' : '';
                                                return `${value} (${sign}${percent}%)`;
                                            }
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            filter: function(tooltipItem) {
                                                // Only show tooltip for line dataset
                                                return tooltipItem.dataset.type === 'line';
                                            },
                                            intersect: false,
                                            callbacks: {
                                                label: (context) => {
                                                    const value = context.parsed.y;
                                                    if (value === 0) return '';
                                                    const index = context.dataIndex;
                                                    if (index === 0) return `${value} Booking`;
                                                    const prev = context.dataset.data[index - 1];
                                                    if (prev === 0) return `${value} Booking`;
                                                    const diff = value - prev;
                                                    const percent = ((diff / prev) * 100).toFixed(1);
                                                    const sign = percent > 0 ? '+' : '';
                                                    return `${value} Booking (${sign}${percent}%)`;
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
