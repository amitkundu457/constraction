<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create Word Document')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Word')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('word.create')); ?>" method="POST" enctype="multipart/form-data" id="word">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12 shadow my-3">
                <input type="hidden" name="editor_data" id="editorData" value=''>
                <div class="d-flex justify-content-between align-items-center py-4 px-3">
                    <div>
                        <a href="<?php echo e(route('word.index')); ?>" class="text-dark"><i
                                class="ti ti-chevron-left"></i><span>Back</span></a>
                    </div>
                    <div class="">
                        <input type="text" name="name" class="form-control" placeholder="Save file as" required>
                    </div>
                    <div class="">
                        <button type="button" onclick="loadEditorData(event)"
                            class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="ti ti-device-floppy"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>
                <div id="editorjs"></div>
                <div class="d-flex justify-content-between align-items-center px-5 my-2" x-data="loadPreview()">
                    <div class="d-flex flex-column align-items-center px-3">
                        <input type="file" x-on:change="change($event,'left')" name="sig_sender" class="d-none"
                            id="left">
                            <input type="text" class="form-control" name="ltext" placeholder="enter text">
                        <img x-cloak x-show="limage" height="50" :src="limage" alt="" x-on:click="document.getElementById('left').click()" style="cursor: pointer">
                        <button x-show="!limage" type="button" class="btn btn-default"
                            x-on:click="document.getElementById('left').click()"><i class="ti ti-upload"></i> <span> Click
                                To upload</span></button>
                        <p class="text-sm font-medium py-1" style="border-top:1px solid black">Signature By Company</p>
                    </div>
                    <div class="d-flex flex-column align-items-center px-3">
                        <input type="file" x-on:change="change($event,'right')" name="sig_receiver" class="d-none"
                            id="right">
                            <input type="text" class="form-control" name="rtext" placeholder="enter text">
                        <img x-cloak x-show="rimage" height="50" :src="rimage" alt="" x-on:click="document.getElementById('right').click()" style="cursor: pointer">
                        <button type="button" x-show="!rimage" class="btn"
                            x-on:click="document.getElementById('right').click()"><i class="ti ti-upload"></i> <span> Click
                                To upload</span></button>
                        <p class="text-sm font-medium py-1" style="border-top:1px solid black">Signature By Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-text-alignment-blocktune@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@canburaks/text-align-editorjs@latest"></script>
    <script>
        const editor = new EditorJS({
            holder: 'editorjs',
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

        function loadEditorData(e) {
            e.preventDefault();
            editor.save().then((outputData) => {
                document.getElementById('editorData').value = JSON.stringify(outputData);
                document.getElementById('word').submit();
            }).catch((error) => {
                console.error('Saving failed:', error);
                event.preventDefault();
            });
        }



        function loadPreview() {
            return {
                limage: null,
                rimage: null,

                change(event, side) {
                    let file = event.target.files[0]

                    if (side == 'left') {
                        this.limage = this.readFile(file)
                    }
                    if (side == 'right') {
                        this.rimage = this.readFile(file)
                    }
                },

                readFile(file) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            resolve(e.target.result);
                        };
                        reader.onerror = (error) => {
                            reject(error);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/word/create.blade.php ENDPATH**/ ?>