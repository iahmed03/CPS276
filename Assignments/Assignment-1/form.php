<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Form Project</title>
</head>
<body>
<br>
<div class="container">
<form class="row g-3" action="#" method="post">
  <div class="col-md-6">
    <label for="firstName" class="form-label">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName">
  </div>
  <div class="col-md-6">
    <label for="lastName" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName">
  </div>
  <div class="col-12">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address">
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city">
  </div>
  <div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <select id="state" name="state" class="form-select">
      <option value="california">California</option>
      <option value="texas">Texas</option>
      <option value="michigan" selected>Michigan</option>
      <option value="florida">Florida</option>
      <option value="virginia">Virginia</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="zip" class="form-label">Zipcode</label>
    <input type="text" class="form-control" id="zip" name="zipCode">
  </div>
  <div class="col-auto">
    <div class="form-check">
      <label class="form-check-label"><input class="form-check-input" type="radio" id="radio1" name="gender" value="male"> Male </label>
    </div>
  </div>
  <div class="col-auto">
    <div class="form-check">
      <label class="form-check-label"><input class="form-check-input" type="radio" id="radio2" name="gender" value="female"> Female </label>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
</form>
</div>
</body>
</html>

