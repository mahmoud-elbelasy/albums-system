<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" value="{{ $album->name ?? '' }}" required>
</div>

<button type="submit" class="btn btn-success">{{ $buttonText }}</button>
