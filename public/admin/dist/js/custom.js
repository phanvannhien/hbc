function selectImageWithCKFinder( elementId ) {
    CKFinder.popup( {
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                console.log( file );
                var img = jQuery( elementId ).find('img');
                var fileinput = jQuery( elementId ).find('input[name="image"]');
                $(img).attr('src', file.getUrl() );
                $( fileinput ).val( file.getUrl() );

            } );

            finder.on( 'file:choose:resizedImage', function( evt ) {
                var output = document.getElementById( elementId );
                output.value = evt.data.resizedUrl;
            } );
        }
    } );
}


$(function () {
    $( 'textarea.editor' ).each(function(index, item){
        $(item).ckeditor({
            filebrowserBrowseUrl: '/ckfinder/browser',
            filebrowserUploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        });
    });


    $('.select-single-image').on('click', function(){
        selectImageWithCKFinder( this );
    });


})