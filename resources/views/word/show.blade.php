@push('css-page')
    <style>
        /* Optional: Style the print content or the button */
        .print-content {
            display: none;
            /* Hide it from view but keep it in the DOM */
        }
    </style>
@endpush
@extends('layouts.admin')
@section('page-title')
    {{ __('Show Word Document') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Word') }}</li>
@endsection

{{-- @section('action-btn')
    <div class="float-end">
        <button id="save-sheet" class="btn btn-sm btn-primary">
            <i class="ti ti-device-floppy"></i>
            <span>Save</span>
        </button>
    </div>
@endsection --}}

@section('content')
    <div>
        @csrf
        <div class="row">
            <div class="col-md-12 shadow my-3">
                <div class="d-flex justify-content-end align-items-center py-4 px-3">

                    <div class="">
                        <button onclick="printDiv('agreement','agreement_1547QY')"
                            class="btn btn-info d-flex align-items-center gap-1">
                            <i class="ti ti-device-floppy"></i>
                            <span>Print</span>
                        </button>
                    </div>
                </div>
                <div id="agreement">
                    <div id="editorjs"></div>
                    <div class="d-flex justify-content-between align-items-center px-5 my-2">
                        <div class="d-flex flex-column align-items-start pl-5">
                            <p style="margin-bottom: 3px">{{ $word->ltext }}</p>
                            <img height="50" src="{{ Storage::disk('public')->url($word->sig_sender) }}" alt="">
                            <p class="text-sm font-medium py-1" style="border-top:1px solid black">Signature By Company</p>
                        </div>
                        <div class="d-flex flex-column align-items-start pr-5">
                            <p style="margin-bottom: 3px">{{ $word->rtext }}</p>
                            <img height="50" src="{{ Storage::disk('public')->url($word->sig_receiver) }}"
                                alt="">
                            <p class="text-sm font-medium py-1" style="border-top:1px solid black">Signature By Company</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    @endsection
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/editorjs-text-alignment-blocktune@latest"></script>
        <script>
            const editor = new EditorJS({
                holder: 'editorjs',
                readOnly: true,
                data: @json(json_decode($word->body)),
                tools: {
                    header: {
                        class: Header,
                        tunes: ['anyTuneName'],
                    },
                    paragraph: {
                        class: Paragraph,
                        inlineToolbar: true,
                        tunes: ['anyTuneName'],
                    },
                    table: Table,
                    list: {
                        class: List,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        }
                    },
                    anyTuneName: {
                        class: AlignmentBlockTune,
                        config: {
                            default: "left",

                        },
                    },
                },
                placeholder: 'Start writing your content here...',
            });

            function printDiv(divName, filename) {
                const printContents = document.getElementById(divName).innerHTML;
                const originalContents = document.body.innerHTML;
                const originalTitle = document.title;
                document.title = filename;
                document.body.innerHTML = printContents;
                window.print();
                document.title = originalTitle;
                document.body.innerHTML = originalContents;
            }
        </script>
    @endpush
