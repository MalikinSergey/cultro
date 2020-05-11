<script src="/js/ckeditor/build/ckeditor.js"></script>


<script>
  ClassicEditor
    .create( document.querySelector( '.editor' ), {

      toolbar: {
        items: [
          'heading',
          'fontSize',
          '|',
          'bold',
          'italic',
          'underline',
          'link',
          'bulletedList',
          'numberedList',
          '|',
          'indent',
          'outdent',
          '|',
          'imageUpload',
          'blockQuote',
          'insertTable',
          'mediaEmbed',
          'undo',
          'redo',
          '|',
          'removeFormat'
        ]
      },
      language: 'ru',
      image: {
        toolbar: [
          'imageTextAlternative',
          'imageStyle:full',
          'imageStyle:side'
        ]
      },
      licenseKey: '',

    } )
    .then( editor => {
      window.editor = editor;




    } )
    .catch( error => {
      console.error( 'Oops, something gone wrong!' );
      console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
      console.warn( 'Build id: pn4g9olvtlu3-89ar70tvum6u' );
      console.error( error );
    } );
</script>

<style>
    .ck-editor__editable{
        height: 200px;
    }
</style>