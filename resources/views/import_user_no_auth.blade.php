<!DOCTYPE html>
<html>
<body>

<form action="{{ route('user.import') }}" method="post" enctype="multipart/form-data">
    @csrf
  Select file user import to upload:
  <input type="file" name="file" id="file" required>
  <input type="submit" value="Import User File">
</form>

</body>
</html>
