@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ __('Notes') }}</div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('notes.create') }}"
                                   class="btn btn-primary m-2">{{ __('Add Note') }}</a>
                            </div>
                            <br>
                            <div class="table-responsive">
                                {{$dataTable->table()}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.jqueryui.min.css">
@endsection
@section('javascript')
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.jqueryui.min.js"></script>
    {{$dataTable->scripts()}}
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
