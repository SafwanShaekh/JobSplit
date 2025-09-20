@extends('layouts.app')

@section('content')

    <div class="content_dashboard scrollbar_custom max-h-full w-full h-fit bg-surface">
        <div class="container w-full lg:py-15 sm:py-12 py-8">
          
        
            <h4 class="heading4 max-lg:mt-3">Dashboard</h4>
            <ul class="list_counter grid 2xl:grid-cols-4 grid-cols-2 sm:gap-7.5 gap-5 mt-7.5 w-full">
                <li class="counter_item applied_job flex items-center justify-between sm:gap-4 gap-3 sm:p-6 p-5 rounded-lg bg-white">
                    <div class="counter_content">
                        <span class="text-secondary">Jobs Posted</span>
                        {{-- This was 80 before --}}
                        <h4 class="number heading4 mt-1">{{ $jobsPostedCount }}</h4>
                    </div>
                    <div class="counter_icon flex flex-shrink-0 items-center justify-center sm:w-[72px] w-12 sm:h-[72px] h-12 rounded-full bg-gradient">
                        <span class="ph-fill ph-briefcase sm:text-3xl text-2xl text-white"></span>
                    </div>
                </li>
                <li class="counter_item services_offered flex items-center justify-between sm:gap-4 gap-3 sm:p-6 p-5 rounded-lg bg-white">
                    <div class="counter_content">
                        <span class="text-secondary">Applied Jobs</span> {{-- You named this "Applied Jobs" --}}
                        {{-- This was 192 before --}}
                        <h4 class="number heading4 mt-1">{{ $appliedJobsCount }}</h4>
                    </div>
                    <div class="counter_icon flex flex-shrink-0 items-center justify-center sm:w-[72px] w-12 sm:h-[72px] h-12 rounded-full bg-gradient">
                        <span class="ph-fill ph-notepad sm:text-3xl text-2xl text-white"></span>
                    </div>
                </li>
                <li class="counter_item views_profile flex items-center justify-between sm:gap-4 gap-3 sm:p-6 p-5 rounded-lg bg-white">
                    <div class="counter_content">
                        <span class="text-secondary">Total Applicants</span> {{-- You named this "Total Applicants" --}}
                        {{-- This was 1280 before --}}
                        <h4 class="number heading4 mt-1">{{ $totalApplicantsCount }}</h4>
                    </div>
                    <div class="counter_icon flex flex-shrink-0 items-center justify-center sm:w-[72px] w-12 sm:h-[72px] h-12 rounded-full bg-gradient">
                        <span class="ph-fill ph-eye sm:text-3xl text-2xl text-white"></span>
                    </div>
                </li>
                <li class="counter_item total_reviews flex items-center justify-between sm:gap-4 gap-3 sm:p-6 p-5 rounded-lg bg-white">
                    <div class="counter_content">
                        <span class="text-secondary">Total Reviews</span>
                        <h4 class="number heading4 mt-1">{{ auth()->user()->rating_count }}</h4>
                    </div>
                    <div class="counter_icon flex flex-shrink-0 items-center justify-center sm:w-[72px] w-12 sm:h-[72px] h-12 rounded-full bg-gradient">
                        <span class="ph-fill ph-thumbs-up sm:text-3xl text-2xl text-white"></span>
                    </div>
                </li>
            </ul>

            <!-- graph  -->
            <div class="chart_overview flex max-xl:flex-col gap-7.5 mt-7.5">
                <div class="w-full h-full rounded-lg bg-white">
                    <div class="flex flex-wrap justify-between gap-6 p-6">
                        <h5 class="heading5"> Applied Jobs OverView</h5>
                        <div class="menu_time flex flex-wrap gap-7.5">
                            <button id="one_week" class="button_time line-before line-black line-2px text-button text-secondary">Week</button>
                            <button id="one_month" class="button_time line-before line-black line-2px text-button text-secondary">Month</button>
                            <button id="one_year" class="button_time line-before line-black line-2px text-button text-secondary active">Year</button>
                        </div>
                    </div>
                    <div class="chart md:px-6 pb-6">
                        <div id="chart-timeline"></div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Make sure ApexCharts is loaded
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts library is not loaded.');
        return;
    }

    // Chart options configuration
    var options = {
        series: [{
            name: 'Applied Jobs',
            data: [] // We will fill this with data from our API
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'category',
            categories: [] // We will fill this with labels from our API
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy'
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
    chart.render();

    // Get the buttons
    const weekBtn = document.getElementById('one_week');
    const monthBtn = document.getElementById('one_month');
    const yearBtn = document.getElementById('one_year');
    const buttons = [weekBtn, monthBtn, yearBtn];

    // Function to fetch data and update the chart
    async function fetchChartData(period) {
        try {
            // Add a loading indicator here if you want
            const response = await fetch(`/dashboard/chart-data?period=${period}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();

            // Update the chart with the new data
            chart.updateOptions({
                xaxis: {
                    categories: result.labels
                },
                series: [{
                    data: result.data
                }]
            });

        } catch (error) {
            console.error('Failed to fetch chart data:', error);
        }
    }

    // Function to handle button clicks and active state
    function handleButtonClick(period, clickedButton) {
        buttons.forEach(button => button.classList.remove('active'));
        clickedButton.classList.add('active');
        fetchChartData(period);
    }

    // Add event listeners to buttons
    weekBtn.addEventListener('click', () => handleButtonClick('week', weekBtn));
    monthBtn.addEventListener('click', () => handleButtonClick('month', monthBtn));
    yearBtn.addEventListener('click', () => handleButtonClick('year', yearBtn));

    // Initial load - load 'Year' data by default
    handleButtonClick('year', yearBtn);
});
</script>
@endpush