@push('css-page')
    {{-- css luckysheet --}}
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/css/pluginsCss.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/plugins.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/css/luckysheet.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/assets/iconfont/iconfont.css' />
@endpush
@extends('layouts.admin')
@section('page-title')
    {{ __('View Spreadsheet') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Spreadsheet') }}</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12" style="position: relative;height:100%;">
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
                title: @json($share->sheet->title),
                data: @json(json_decode($share->sheet->data)),
                showtoolbar: false,
                functionButton: false,
                showsheetbarConfig: {
                    add: false,
                    sheet: false,
                },
                cellRightClickConfig: {
                    copy: false,
                    copyAs: false,
                    paste: false,
                    insertRow: false,
                    insertColumn: false,
                    deleteRow: false,
                    deleteColumn: false,
                    deleteCell: false,
                    hideRow: false,
                    hideColumn: false,
                    rowHeight: false,
                    columnWidth: false, // column width
                    clear: false, // clear content
                    matrix: false, // matrix operation selection
                    sort: false, // sort selection
                    filter: false, // filter selection
                    chart: false, // chart generation
                    image: false, // insert picture
                    link: false, // insert link
                    data: false, // data verification
                    cellFormat: false // Set cell format
                },
                
                allowCopy: false,
                myFolderUrl: "{{ route('sheet.index') }}"
            };

            luckysheet.create(options);

        });
    </script>
@endpush
