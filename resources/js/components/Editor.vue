<template>
    <div class="flex flex-1 flex-shrink-0 flex-col md:flex-row">
        <!-- Editor -->
        <div id="editor" class="flex-1 flex-shrink-0 relative">
            <textarea ref="editor" v-model="code"></textarea>
        </div>

        <!-- Output -->
        <div id="output" class="flex-1 flex-shrink-0">
            <textarea
                ref="output"
                class="absolute inset-0 h-full w-full bg-transparent flex-shrink-0 resize-none p-4 font-mono focus:outline-none text-gray-400 leading-8"
                readonly>Loading...</textarea>
        </div>
    </div>
</template>

<script>
    // import * as wasm from "learnpy";
    import _CodeMirror from "codemirror";
    import Split from "split.js";
    import * as rp from 'rustpython_wasm';

    window.rp = rp;

    const CodeMirror = window.CodeMirror || _CodeMirror;

    let editorInstance;
    let splitInstance;

    import "codemirror/lib/codemirror.css";
    import "../../css/editor/themes/tailwind.css";
    import "codemirror/mode/python/python";
    import "codemirror/addon/selection/active-line";

    export default {
        name: 'editor',

        data: () => ({
            code: '',
        }),

        created() {
            window.addEventListener('resize', this.initializeSplits);
        },

        destroyed() {
            window.removeEventListener('resize', this.initializeSplits);
        },

        mounted() {
            this.initializeEditor();
            this.initializeSplits();
        },

        methods: {
            initializeEditor() {
                editorInstance = CodeMirror.fromTextArea(this.$refs.editor, {
                    autofocus: true,
                    extraKeys: {
                        'Ctrl-R': this.run,
                        'Cmd-R': this.run,
                        'Shift-Tab': 'indentLess',
                        'Ctrl-/': 'toggleComment',
                        'Cmd-/': 'toggleComment',
                        Tab: editor => {
                            var spaces = Array(editor.getOption('indentUnit') + 1).join(' ');
                            editor.replaceSelection(spaces);
                        }
                    },
                    gutters: ["CodeMirror-linenumbers", "breakpoints"],
                    indentUnit: 4,
                    lineNumbers: true,
                    lineWrapping: true,
                    mode: 'text/x-python',
                    styleActiveLine: true,
                    theme: 'tailwind'
                });

                editorInstance.on("gutterClick", (editor, n) => {
                    var info = editorInstance.lineInfo(n);
                    editorInstance.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : this.makeMarker());
                });

                editorInstance.on('change', editor => {
                    this.code = editor.getValue();
                    if (this.$emit) {
                        this.$emit('input', this.code);
                    }
                });
            },

            initializeSplits() {
                if (splitInstance) splitInstance.destroy();

                splitInstance = Split(['#editor', '#output'], {
                    direction: window.innerWidth >= 768 ? 'horizontal' : 'vertical',
                    minSize: [250, 250],
                    elementStyle: (dimension, size, gutterSize) => {
                        return {
                            'flex-basis': 'calc(' + size + '% - ' + gutterSize + 'px)',
                        }
                    },
                    gutter: (index, direction) => {
                        const gutter = document.createElement('div');
                        if (direction === 'horizontal') {
                            gutter.className = 'flex flex-shrink-0 items-center justify-center px-2 md:px-1 bg-gray-800 cursor-col-resize';
                            gutter.innerHTML = `
                                <svg class="text-gray-600 h-4 md:h-3" viewBox="0 0 8 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 17V1H5v16h2zM1 1v16h2V1H1z" />
                                </svg>
                            `;
                        } else {
                            gutter.className = 'flex flex-shrink-0 items-center justify-center py-2 md:py-1 bg-gray-800 cursor-row-resize';
                            gutter.innerHTML = `
                                <svg class="text-gray-600 w-4 md:w-3" viewBox="0 0 18 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7h16V5H1v2zm16-6H1v2h16V1z" />
                                </svg>
                            `;
                        }
                        return gutter;
                    },
                    gutterStyle: (dimension, gutterSize) => {
                        return {
                            'flex-basis': gutterSize + 'px',
                        }
                    },
                });
            },

            makeMarker() {
                var marker = document.createElement("div");
                marker.className = "CodeMirror-gutter-breakpoint";
                marker.innerHTML = "●";
                return marker;
            },

            run() {
                let vm = this;

                vm.$refs.output.value = '';

                try {
                    rp.pyEval(vm.code, {
                        stdout: output => {
                            const shouldscroll = vm.$refs.output.scrollHeight - vm.$refs.output.scrollTop === vm.$refs.output.clientHeight;
                            vm.$refs.output.value += output;

                            console.log(output);
                            if (shouldscroll) {
                                vm.$refs.output.scrollTop = vm.$refs.output.scrollHeight;
                            }
                        }
                    })
                } catch (err) {
                    if (err instanceof WebAssembly.RuntimeError) {
                        err = window.__RUSTPYTHON_ERROR || err;
                    }
                    console.error(err);
                }
            }
        }
    }
</script>

<style>
    .CodeMirror {
        @apply absolute inset-0 bg-transparent h-full w-full resize-none font-mono text-gray-400 leading-8 pr-4 flex-shrink-0;
    }

    .CodeMirror:focus {
        @apply outline-none;
    }

    .CodeMirror-gutter {
        padding: 1rem 0.5rem;
    }

    .CodeMirror-gutter-elt {
        @apply cursor-pointer;
    }

    .CodeMirror-lines {
        @apply pr-0 py-4;
    }

    .CodeMirror-linenumber {
        @apply pl-4;
    }
</style>
