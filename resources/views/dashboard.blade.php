@extends('layouts.app')

@section('title')
    EVENTS
@endsection

@section('after-styles')
    <link rel="stylesheet" href="{{ asset('css/clientCss.css') }}">
    <style>
        .fc-scrollgrid-section.fc-scrollgrid-section-body {
            display: none;
        }

        .fc-scrollgrid-section-liquid {
            display: contents !important;
        }
    </style>
@endsection

@section('content')
    <div class=" mb-10 ">
        <div id='calendar' class="bg-gray-50 p-5 shadow-2xl rounded-lg drop-shadow-2xl"></div>
    </div>
@endsection


@section('after-scripts')
    <script></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
            toastr.options = ToasterOptions;
        </script>
    @endif

    @if (Session::has('fail'))
        <script>
            toastr.error("{{ Session::get('fail') }}");
            toastr.options = ToasterOptions;
        </script>
    @endif
    <script src="{{ asset('fullcalendar/fullcalendarglobal.js') }}"></script>
    <script src="{{ asset('js/clientJs.js') }}"></script>
@endsection

@section('modal')
    @include('modals.editNotification')
@endsection
