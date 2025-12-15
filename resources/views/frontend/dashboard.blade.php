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
    <script src="{{ asset('assets/js/chartjs-plugin-annotation@2.js') }}"></script>




    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center bg-white mt-2 dark:bg-white" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">

            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="true">
                    Booking by Year
                </button>
            </li>

            @foreach ($rooms as $room)
                @php
                    $roomId = Str::slug($room, '_'); // convert to safe ID
                @endphp

                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                        id="room_123{{ $roomId }}" data-tabs-target="#test_room123{{ $roomId }}" type="button"
                        role="tab" aria-controls="test_room123{{ $roomId }}" aria-selected="false">
                        {{ $room }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:white" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">

            <div class="grid grid-cols-2 gap-2">

                <script>
                    // Manual months array
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    const chart = 'line';
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
                            const dataValues_{{ $id }} = Array.isArray(@json($data)) ? @json($data) :
                                [];
                            const maxValue_{{ $id }} = Math.max(...dataValues_{{ $id }});
                            const minValue_{{ $id }} = Math.min(...dataValues_{{ $id }});


                            const ctx_{{ $id }} = document.getElementById("Chart_{{ $id }}");



                            const chartData_{{ $id }} = {
                                labels: months,
                                datasets: [{
                                    type: chart,
                                    label: 'Monthly Records',
                                    data: dataValues_{{ $id }},
                                    backgroundColor: "rgba(0,255,255,0.4)", // cyan bars
                                    borderColor: "cyan",
                                    borderWidth: 3, // <-- increased line thickness
                                    borderSkipped: false,
                                    borderRadius: 0,
                                    barPercentage: 0.6,
                                    categoryPercentage: 0.8,
                                    tension: 0.4, // <-- optional for smoother line (works for line charts)
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
                                type: chart,
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
        @foreach ($rooms as $room)
            @php
                $roomId = Str::slug($room, '_');

                $departmentChartData = \App\Models\Booking::select('department', DB::raw('COUNT(*) as total'))
                    ->whereYear('date', $year)
                    ->where('room', $room)
                    ->where('status', 1)
                    ->groupBy('department')
                    ->get();

                $departmentNames = $departmentChartData->pluck('department');
                $departmentTotals = $departmentChartData->pluck('total');

                // Pastel background colors
                $bgColors = [
                    '#FFB3BA',
                    '#BAE1FF',
                    '#BAFFC9',
                    '#FFFFBA',
                    '#FFDFBA',
                    '#E0BBE4',
                    '#C1F0F6',
                    '#FFDAC1',
                    '#F3C1FF',
                    '#C1FFD7',
                    '#FFD6C1',
                    '#C1D4FF',
                    '#FFE4C1',
                    '#D1C1FF',
                    '#C1FFF3',
                    '#FFC1E3',
                    '#E8FFC1',
                    '#C1E8FF',
                    '#FFE1F0',
                    '#DFFFD6',
                ];
                // Slightly darker borders
                $borderColors = [
                    '#FF8C8C',
                    '#8CC2FF',
                    '#8CFF99',
                    '#FFFF8C',
                    '#FFB78C',
                    '#D099D9',
                    '#8CC6CC',
                    '#FFB780',
                    '#C77DFF',
                    '#7DFFB2',
                    '#FF9F7D',
                    '#7D9FFF',
                    '#FFB97D',
                    '#9F7DFF',
                    '#7DFFE8',
                    '#FF7DB2',
                    '#B2FF7D',
                    '#7DB2FF',
                    '#FF7DAA',
                    '#9FFF7D',
                ];
            @endphp

            <div class="hidden p-10  m-5 rounded-lg bg-gray-50 dark:bg-gray-800" id="test_room123{{ $roomId }}"
                role="tabpanel" aria-labelledby="room_123{{ $roomId }}">

                <h2 class="font-bold mb-10  p-5 text-lg">{{ $room }}</h2>
                <div class="chart_control ">
                    <canvas id="Donut_{{ $roomId }}" style="height: 400px;"></canvas>
                </div>

                <script>
                    {
                        const ctx = document.getElementById("Donut_{{ $roomId }}").getContext("2d");

                        const totals = @json($departmentTotals);
                        const totalSum = totals.reduce((a, b) => a + b, 0);

                        new Chart(ctx, {
                            type: "doughnut",
                            data: {
                                labels: @json($departmentNames),
                                datasets: [{
                                    data: totals,
                                    backgroundColor: @json($bgColors),
                                    borderColor: @json($borderColors),
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '70%',
                                layout: {
                                    padding: {
                                        top: 40,
                                        bottom: 120,
                                        left: 40,
                                        right: 40
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 20,
                                            padding: 15,
                                            font: {
                                                size: 9
                                            }
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const percent = ((context.raw / totalSum) * 100).toFixed(1);
                                                return `${context.label}: ${context.raw} bookings (${percent}%)`;
                                            }
                                        }
                                    },
                                    datalabels: {
                                        display: function(context) {
                                            const value = context.dataset.data[context.dataIndex];
                                            const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                                            return (value / total) * 100 > 5;
                                        },
                                        color: '#000',
                                        font: {
                                            weight: 'bold',
                                            size: 10
                                        },
                                        anchor: 'center',
                                        align: 'center',
                                        offset: 0,
                                        formatter: (value, context) => {
                                            const dataArr = context.chart.data.datasets[0].data.map(
                                            Number); // force to numbers
                                            const total = dataArr.reduce((sum, val) => sum + val, 0);
                                            if (total === 0) return value + ' (0%)'; // handle no data
                                            const percent = ((value / total) * 100).toFixed(1) + '%';
                                            return value + ' (' + percent + ')';
                                        }
                                    }
                                }
                            },
                            plugins: [ChartDataLabels]
                        });
                    }
                </script>


            </div>
        @endforeach


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

        if (window.ChartDataLabels) {
            Chart.register(ChartDataLabels);
        }
    </script>
@endsection
