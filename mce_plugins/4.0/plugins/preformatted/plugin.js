

tinymce.PluginManager.add('preformatted', function(editor) {
    function showDialog() {
        var e = tinymce.activeEditor.selection.getNode();
        if ( e.nodeName == 'CODE' ) {
            editor.execCommand('mceRemoveNode', false, editor.dom.getParent(e, 'CODE'));
            editor.nodeChanged();
        } else if (editor.selection.isCollapsed() || e.nodeName == 'PRE') {
            tinymce.activeEditor.selection.select(editor.dom.getParent(e, 'PRE'));
            editor.windowManager.open({
                title: "Source code",
                body: {
                    type: 'textbox',
                    name: 'preformatted',
                    multiline: true,
                    minWidth: editor.getParam("code_dialog_width", 600),
                    minHeight: editor.getParam("code_dialog_height", Math.min(tinymce.DOM.getViewPort().h - 200, 500)),
                    value: tinymce.activeEditor.selection.getContent({format: 'text'}),
                    spellcheck: false,
                    style: 'direction: ltr; text-align: left'
                },
                onSubmit: function(e) {
                    // We get a lovely "Wrong document" error in IE 11 if we
                    // don't move the focus to the editor before creating an undo
                    // transation since it tries to make a bookmark for the current selection
                    editor.focus();

                    editor.undoManager.transact(function() {
                        editor.insertContent('<pre>' + escapeHtml(e.data.preformatted) + '</pre>');
                    });

                    editor.selection.setCursorLocation();
                    editor.nodeChanged();
                }
            });
        } else {
            editor.undoManager.transact(function() {
                tinymce.activeEditor.selection.setNode(tinymce.activeEditor.dom.create(
                    'code',
                    {},
                    editor.selection.getContent()
                ));
            });
        }
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    };

    editor.addCommand("mceCodeEditor", showDialog);

    editor.addButton('preformatted', {
        icon: 'code',
        tooltip: 'Source code',
        onclick: showDialog,
        onPostRender: function(){
            var ctrl = this;
            editor.on("NodeChange", function(e) {
                ctrl.active(e.element.nodeName == 'CODE' || e.element.nodeName == 'PRE');
            });
        }
    });

    editor.addMenuItem('preformatted', {
        icon: 'code',
        text: 'Source code',
        context: 'tools',
        onclick: showDialog
    });
});

