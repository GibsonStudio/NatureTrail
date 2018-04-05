tinymce.init({
  mode: 'specific_textareas', editor_selector:'use_tinymce',
  menu: {
    file: { title:'File', items:'newdocument' },
    tools: { title:'Tools', items:'code' }
  },
  plugins:['code']
});
