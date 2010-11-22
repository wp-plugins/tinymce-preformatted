(function() {
	var each = tinymce.each;

	tinymce.create('tinymce.plugins.mcePreformatted', {
		init : function(ed, url) {
			var t = this;

			t.editor = ed;

			// Register commands
			ed.addCommand('mcePreformatted', function(ui) {
				ed.windowManager.open({
					file : url + '/preformatted.html',
					width : ed.getParam('preformatted_popup_width', 420),
					height : ed.getParam('preformatted_popup_height', 300),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('mceInsertPreformattedText', t._insertPreformattedText, t);

			// Register buttons
			ed.addButton('preformatted', {
                title : 'preformatted_dlg.desc', 
                cmd : 'mcePreformatted',
                image : url + '/img/icon.png'
            });
		},

		_insertPreformattedText : function(content) {
            var pre = document.createElement('pre');
            if (typeof pre.textContent != 'undefined') {
                pre.textContent = content;
            } else {
                pre.innerText = content;
            }
            var block = document.createElement('div');
            block.appendChild(pre);
            ed = this.editor;
			ed.execCommand('mceInsertContent', false, block.innerHTML);
			ed.addVisual();
		}
	});

	// Register plugin
	tinymce.PluginManager.add('preformatted', tinymce.plugins.mcePreformatted);
})();
