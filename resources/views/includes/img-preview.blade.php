<script>
    let prevImageSrc = document.getElementById('img-preview').getAttribute('data-prev-src');

    function loadFile(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('img-preview').src = reader.result;
                document.getElementById('cancelButton').style.display = 'inline';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('img-preview').src = prevImageSrc;
            document.getElementById('cancelButton').style.display = 'none';
        }
    }

    function cancelUpload() {
        document.getElementById('img-preview').src = prevImageSrc;
        document.getElementById('getFile').value = null;
        document.getElementById('cancelButton').style.display = 'none';
        console.log('prevImageSrc:', prevImageSrc);
    }
</script>
