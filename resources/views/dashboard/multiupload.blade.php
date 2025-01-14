<!DOCTYPE html>
<html>
<head>
    <title>Upload Images</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
</head>
<body>
<div class="container">
    <h1>Upload Images to Album: {{ $album->name }}</h1>
    <form method="post" action="{{ route('albums.storeImage', $album->id) }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        @csrf
    </form>
    <a href="{{ route('albums.index') }}" class="btn btn-primary">Back to Albums</a>
</div>
<script type="text/javascript">
Dropzone.options.dropzone = {
    maxFilesize: 12,
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time + file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    timeout: 5000,
    success: function(file, response) {
        console.log(response);
    },
    error: function(file, response) {
        console.log(response);
    }
};
</script>
</body>
</html>
