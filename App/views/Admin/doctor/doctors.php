<?php
use App\Models\Doctor;

$doctors = Doctor::getAll($pdo);
?>

<h1>Doctors Management</h1>


<h2>Add Doctor</h2>

<form action="index.php?action=add" method="POST">

    <input type="text" name="name" placeholder="Doctor Name">

    <input type="email" name="email" placeholder="Email">

    <input type="password" name="password" placeholder="Password">

    <input type="text" name="phone" placeholder="Phone">


    <select name="major_id">
        <option value="1">Cardiology</option>
        <option value="2">Dentist</option>
        <option value="3">Neurology</option>
    </select>


    <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>


    <input type="text" name="image" placeholder="Image URL">

    <textarea name="description" placeholder="Description"></textarea>


    <button type="submit">Add Doctor</button>

</form>


<hr>


<h2>Doctors List</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Major</th>
        <th>Actions</th>
    </tr>


    <?php foreach($doctors as $doctor): ?>

        <tr>

            <td><?= $doctor['id']; ?></td>

            <td><?= $doctor['name']; ?></td>

            <td><?= $doctor['email']; ?></td>

            <td><?= $doctor['phone']; ?></td>

            <td><?= $doctor['gender']; ?></td>

            <td><?= $doctor['major_title']; ?></td>

            <td>

                <a href="index.php?page=admin-doctors&action=delete&id=<?= $doctor['id']; ?>">
                    Delete
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>