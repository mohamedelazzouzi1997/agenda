@extends('layouts.app')

@section('title')
    ADMIN EVENTS
@endsection

@section('after-styles')
    <link rel="stylesheet" href="{{ asset('css/adminCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jqueryConfirm.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
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
        <div class="">
            <form action="{{ route('admin.dashboard') }}" class="flex space-x-10 justify-center items-center" method="get">
                @csrf
                <div class="grid grid-cols-1">
                    <select class=" ms shadow-md select2" aria-placeholder="Select" name="filter">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                    <button name="filterButton" type="submit" class="btn btn-primary shadow-md">Filter</button>
                </div>
            </form>
            <div>
                @if ($current_user == 'all')
                    All Users
                @else
                    <span class="text-xl font-extrabold text-green-500">User :</span> {{ $current_user->name }}
                @endif
            </div>
        </div>
        <div id='calendar' class="bg-gray-50 p-5 my-5 shadow-2xl rounded-lg drop-shadow-2xl">

        </div>
    </div>
@endsection


@section('after-scripts')
    <script>
        var eventDtat = {{ Js::from($eventsData) }};
    </script>
    <script src="{{ asset('fullcalendar/fullcalendarglobal.js') }}"></script>
    <script src="{{ asset('js/jqueryConfirm.js') }}"></script>
    <script src="{{ asset('js/adminJs.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>


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
    <script>
        $('.select2').select2()
    </script>
@endsection

@section('modal')
    @include('modals.admin.editNotification')
@endsection
