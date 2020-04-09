<template>
    <div class="flex flex-1 flex-shrink-0 flex-col md:flex-row">
        <!-- Editor -->
        <div id="editor" class="flex-1 flex-shrink-0 relative">
            <textarea ref="editor"></textarea>
        </div>

        <!-- Output -->
        <div id="output" class="flex-1 flex-shrink-0">
            <textarea class="bg-transparent flex-shrink-0 flex-1 resize-none p-4 font-mono focus:outline-none text-gray-400 leading-8" readonly>Loading...</textarea>
        </div>
    </div>
</template>

<script>
    // import * as wasm from "learnpy";
    import _CodeMirror from "codemirror";
    import Split from "split.js";

    const CodeMirror = window.CodeMirror || _CodeMirror;

    let editorInstance;
    let splitInstance;

    import "codemirror/lib/codemirror.css";
    import "../../css/editor/themes/tailwind.css";
    import "codemirror/mode/python/python";
    import "codemirror/addon/selection/active-line";

    export default {
        name: 'editor',

        created() {
            window.addEventListener('resize', this.initializeSplits);
        },

        destroyed() {
            window.removeEventListener('resize', this.initializeSplits);
        },

        mounted() {
            // wasm.greet();
            this.initializeEditor();
            this.initializeSplits();
        },

        methods: {
            initializeEditor() {
                editorInstance = CodeMirror.fromTextArea(this.$refs.editor, {
                    autofocus: true,
                    gutters: ["CodeMirror-linenumbers", "breakpoints"],
                    lineNumbers: true,
                    lineWrapping: true,
                    mode: 'python',
                    styleActiveLine: true,
                    theme: 'tailwind'
                });

                editorInstance.on("gutterClick", (editor, n) => {
                    var info = editorInstance.lineInfo(n);
                    editorInstance.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : this.makeMarker());
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
                            gutter.className = 'flex flex-shrink-0 items-center justify-center px-1 bg-gray-800 cursor-col-resize';
                            gutter.innerHTML = `
                                <svg class="text-gray-600 h-3" viewBox="0 0 8 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 17V1H5v16h2zM1 1v16h2V1H1z" />
                                </svg>
                            `;
                        } else {
                            gutter.className = 'flex flex-shrink-0 items-center justify-center py-1 bg-gray-800 cursor-row-resize';
                            gutter.innerHTML = `
                                <svg class="text-gray-600 w-3" viewBox="0 0 18 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
