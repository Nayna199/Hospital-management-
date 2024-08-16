<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
   
<style>
    body {
        font-family: 'Helvetica', sans-serif;
        margin: 0;
        padding: 0;
        background-color: plum;
        background: url('myhoss.png') no-repeat center center fixed;
        background-size: contain;
    }

    h1 {
        color: brown;
        text-align: center;
        margin-top: 20px;
    }

    form {
        width: 60%;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-top: 10px;
        color: brown;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        box-sizing: border-box;
    }

    input[type="radio"] {
        margin-top: 5px;
        margin-right: 5px;
    }

    button {
        background-color: purple;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        font-family: 'Helvetica', sans-serif;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: plum;
        color: papayawhip;
    }

    #image_preview {
        max-width: 200px;
        display: block;
        margin-top: 10px;
    }
</style>

</head>

<body>

    <h1>Edit Patient</h1>

    <form action="update_patient.php" method="POST">
        <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $patient['first_name']; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $patient['last_name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $patient['email']; ?>" required>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $patient['phone_number']; ?>" required>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="male" <?php echo ($patient['gender'] === 'male') ? 'checked' : ''; ?>> Male
        <input type="radio" name="gender" value="female" <?php echo ($patient['gender'] === 'female') ? 'checked' : ''; ?>> Female
        <input type="radio" name="gender" value="other" <?php echo ($patient['gender'] === 'other') ? 'checked' : ''; ?>> Other

        <label for="selected_tests">Selected Tests:</label>
        <input type="text" name="selected_tests" value="<?php echo $patient['tests']; ?>" required>

        <label for="profile_image">Profile Image:</label>
        <input type="file" name="profile_image" id="profile_image">
        <img src="<?php echo $patient['profile_image']; ?>" alt="Profile Image" id="image_preview" style="max-width: 200px;">

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" value="<?php echo $patient['date_of_birth']; ?>" required>

        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $patient['city']; ?>" required>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo $patient['price']; ?>" required>

        <button type="submit">Update</button>
    </form>

    <script>

        document.getElementById('profile_image').addEventListener('change', function (e) {
            var preview = document.getElementById('image_preview');
            preview.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>

</body>

</html>
