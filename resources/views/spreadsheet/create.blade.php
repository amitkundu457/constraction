@push('css-page')
    {{-- css luckysheet --}}
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/css/pluginsCss.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/plugins.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/css/luckysheet.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/assets/iconfont/iconfont.css' />
@endpush
@extends('layouts.admin')
@section('page-title')
    {{ __('Create Spreadsheet') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Spreadsheet') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        {{-- <button data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-share"></i>
            <span>Share</span>
        </button> --}}
        <button id="save-sheet" class="btn btn-sm btn-primary">
            <i class="ti ti-device-floppy"></i>
            <span>Save</span>
        </button>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12" style="position: relative;height:100%; ">
            <form action="{{ route('sheet.create') }}" method="post" id="sheetForm">
                @csrf
                <input type="hidden" id="title" name="title">
                <input type="hidden" id="data" name="data">
            </form>
            <div id="luckysheet" style="margin:0px;padding:0px;position:absolute;width:100%;height:600px;left:0px;top:0px;">
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/js/plugin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/luckysheet.umd.js"></script>
    <script>
        $(document).ready(function() {

            var options = {
                container: 'luckysheet',
                title: 'CRM & Real Estate',
                 myFolderUrl:"{{ route('sheet.index') }}"
            }
            luckysheet.create(options)

            $('#save-sheet').click(function() {
                $("#title").val($('#luckysheet_info_detail_input').val())
                $('#data').val(JSON.stringify(luckysheet.getAllSheets()))
                $("#sheetForm").submit();
            });

            // $('#share-sheet').click(function() {
            //     var sheetData = luckysheet.getAllSheets();

            //     $.ajax({
            //         url: '/spreadsheet/share', // Your route to handle sharing
            //         type: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             data: JSON.stringify(sheetData)
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 alert('Sheet shared successfully. Share this link: ' + response
            //                     .link);
            //                 // Optionally, display the link to the user
            //             } else {
            //                 alert('Error sharing sheet');
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             console.error('Error sharing sheet:', status, error);
            //             alert('Error sharing sheet');
            //         }
            //     });
            // });


        })
    </script>
@endpush
