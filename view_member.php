<?php
include("controller_member.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Employee Management</title>
</head>

<body>
    <div class="container p-3">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="view_member.php">Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_office.php">Office</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <h1>Employee List</h1>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;
                        $allmembers = getAllMember();
                        foreach ($allmembers as $index => $member) {
                            $counter++;
                        ?>
                            <tr>
                                <th scope="row"><?= $counter ?></th>
                                <td><?= $member->name ?></td>
                                <td><?= $member->phone ?></td>
                                <td><?= $member->email ?></td>
                                <td><?= $member->note ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editMember(<?= $index ?>)">Update</button>
                                    <a href="controller_member.php?deleteID=<?= $index ?>">
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <hr class="my-4">

                <h1 id="form-title">Add Employee</h1>
                <form method="POST" action="controller_member.php" class="w-75 mx-auto" id="employee-form">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" name="inputName" id="inputName" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone</label>
                            <input type="text" class="form-control" name="inputPhone" id="inputPhone" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" name="inputEmail" id="inputEmail" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputNote">Note</label>
                            <input type="text" class="form-control" name="inputNote" id="inputNote">
                        </div>
                    </div>
                    <input type="hidden" name="memberID" id="memberID">
                    <button name="button_register" type="submit" class="btn btn-primary" id="submit-btn">Add Employee</button>
                    <button type="button" class="btn btn-secondary" id="cancel-btn" onclick="cancelEdit()" style="display: none;">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const memberData = <?= json_encode($allmembers) ?>;

        function editMember(index) {
            const member = memberData[index];
            if (!member) return;
            document.getElementById('form-title').textContent = 'Update Employee';
            document.getElementById('submit-btn').textContent = 'Update Employee';
            document.getElementById('submit-btn').name = 'button_update';
            document.getElementById('cancel-btn').style.display = 'inline-block';
            document.getElementById('inputName').value = member.name;
            document.getElementById('inputPhone').value = member.phone;
            document.getElementById('inputEmail').value = member.email;
            document.getElementById('inputNote').value = member.note;
            document.getElementById('memberID').value = index;
            document.getElementById('employee-form').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function cancelEdit() {
            document.getElementById('form-title').textContent = 'Add Employee';
            document.getElementById('submit-btn').textContent = 'Add Employee';
            document.getElementById('submit-btn').name = 'button_register';
            document.getElementById('cancel-btn').style.display = 'none';
            document.getElementById('employee-form').reset();
            document.getElementById('memberID').value = '';
        }
    </script>
</body>

</html>