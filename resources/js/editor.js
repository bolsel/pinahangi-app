import '../css/editor.css';
import Editor from '@toast-ui/editor';

window.editor = Editor;

window.editorViewer = (el, config = {}) => {
  return Editor.factory({
    el,
    viewer: true,
    initialValue: el.innerHTML,

    height: '500px',
    ...config
  })
}
// window.wireEditorViewer = (el, value) => {
//   return Editor.factory({
//     el,
//     viewer: true,
//     initialValue: value,
//
//     height: '500px',
//   })
// }
window.wireEditor = (el, options) => {
  const name = options.name;
  const $wire = options.wire;
  const editor = new Editor({
    el,
    height: '500px',
    initialValue: $wire.get(name) ?? el.innerHTML,
    initialEditType: 'wysiwyg',
    previewStyle: 'vertical',
    toolbarItems: [['heading', 'bold', 'italic', 'strike'],
      ['hr', 'quote'],
      ['ul', 'ol', 'task', 'indent', 'outdent'],
      // ['table', 'image', 'link'],
      // ['code', 'codeblock']
    ],
    ...options.merge ?? {}
  });
  editor.on('change', (c) => {
    $wire.set(name, editor.getMarkdown(), false);
  })
  return editor;
}
