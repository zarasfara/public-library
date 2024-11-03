@extends('admin.layouts.base')

@section('title', 'Главная')
@section('heading', 'Посещения')

@section('content')
    <canvas id="visitors-chart"></canvas>
@endsection

@push('admin.scripts')
    <script src="{{ asset('assets/admin/js/chart.min.js') }}"></script>

    <script>
        const ctx = document.getElementById('visitors-chart');

        const labels = {!! $labels !!};
        const visitorData = {!! $visitorData !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Количество посетителей',
                    data: visitorData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
