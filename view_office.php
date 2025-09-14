<?php
include("controller_office.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Office Management</title>
</head>

<body>
    <div class="container p-3">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="view_member.php">Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="view_office.php">Office</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <h1>Office List</h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Office Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;
                        $alloffices = getAllOffice();
                        foreach ($alloffices as $index => $office) {
                            $counter++;
                        ?>
                            <tr>
                                <th scope="row"><?= $counter ?></th>
                                <td><?= $office->name ?></td>
                                <td><?= $office->address ?></td>
                                <td><?= $office->city ?></td>
                                <td><?= $office->phone ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editOffice(<?= $index ?>)">Update</button>
                                    <a href="controller_office.php?deleteID=<?= $index ?>">
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this office?')">Delete</button>
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <hr class="my-4">

                <h1 id="form-title">Add Office</h1>
                <form method="POST" action="controller_office.php" class="w-75 mx-auto" id="office-form">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputName">Office Name</label>
                            <input type="text" class="form-control" name="inputName" id="inputName" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" name="inputAddress" id="inputAddress" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" name="inputCity" id="inputCity" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone</label>
                            <input type="text" class="form-control" name="inputPhone" id="inputPhone" required>
                        </div>
                    </div>
                    <input type="hidden" name="officeID" id="officeID">
                    <button name="button_register" type="submit" class="btn btn-primary" id="submit-btn">Add Office</button>
                    <button type="button" class="btn btn-secondary" id="cancel-btn" onclick="cancelEdit()" style="display: none;">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const officeData = <?= json_encode($alloffices) ?>;

        function editOffice(index) {
            const office = officeData[index];
            if (!office) return;

            document.getElementById('form-title').textContent = 'Update Office';
            document.getElementById('submit-btn').textContent = 'Update Office';
            document.getElementById('submit-btn').name = 'button_update';
            document.getElementById('cancel-btn').style.display = 'inline-block';

            document.getElementById('inputName').value = office.name;
            document.getElementById('inputAddress').value = office.address;
            document.getElementById('inputCity').value = office.city;
            document.getElementById('inputPhone').value = office.phone;
            document.getElementById('officeID').value = index;

            document.getElementById('office-form').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function cancelEdit() {
            document.getElementById('form-title').textContent = 'Add Office';
            document.getElementById('submit-btn').textContent = 'Add Office';
            document.getElementById('submit-btn').name = 'button_register';
            document.getElementById('cancel-btn').style.display = 'none';

            document.getElementById('office-form').reset();
            document.getElementById('officeID').value = '';
        }
    </script>
</body>

</html>