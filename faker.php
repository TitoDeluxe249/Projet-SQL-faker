<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="faker.php">
        <input type="submit" name="generate_data" value="Générer des données">
    </form>


<?php

require 'vendor/autoload.php'; // Include the Faker library

// Database connection information
$host = 'localhost';
$dbname = 'ecommerce';
$username = 'Tito';
$password = 'tito';

// Database connection information
$db = new SQlite3('tables.db');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}

$faker = Faker\Factory::create();

// Définir le nombre d'enregistrements que vous souhaitez insérer
$numberOfRecords = 100;

// Insert data for the 'User' table
for ($i = 0; $i < $numberOfRecords; $i++) {
    // Générer des données factices pour la table User
    $username = $faker->userName;
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $mail = $faker->email;
    $password = password_hash($faker->password, PASSWORD_BCRYPT);

    // Requête SQL pour insérer des données dans la table User
    $sql = "INSERT INTO User (Username, FirstName, LastName, Mail, Password) VALUES (:username, :firstName, :lastName, :mail, :password)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Liens des paramètres
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);

    // Exécuter la requête SQL
    $stmt->execute();

}


// Insérer des données dans la table 'Address'
for ($i = 0; $i < $numberOfRecords; $i++) {
    $userId = $faker->numberBetween(1, $numberOfRecords);// Générer un ID d'utilisateur valide
    $street = $faker->streetAddress;
    $city = $faker->city;
    $zipcode = $faker->postcode; 
    $country = $faker->country;

    // Requête SQL pour insérer des données dans la table Address
    $sql = "INSERT INTO Address (Id_user, Street, City, Country, Zipcode) VALUES (:userId, :street, :city, :country, :zipcode)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Liens des paramètres
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':zipcode', $zipcode);

    // Exécuter la requête SQL
    $stmt->execute();
}


// Insérer des données dans la table 'Product'
for ($i = 0; $i < $numberOfRecords; $i++) {
    $name = $faker->word;
    $prix = $faker->randomFloat(2, 1, 100);
    $description = $faker->realText;
    $category = $faker->word; // Générez une catégorie aléatoire

    // Requête SQL pour insérer des données dans la table Product
    $sql = "INSERT INTO Product (Name, Description, Prix, Category) VALUES (:name, :description, :prix, :category)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Liens des paramètres
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);

    // Exécuter la requête SQL
    $stmt->execute();
}


// Insert data for the 'Command' table
$statuses = ['Pending', 'Shipped', 'Delivered'];

for ($i = 0; $i < $numberOfRecords; $i++) {
    $userID = $faker->numberBetween(1, $numberOfRecords); // Assuming you have User IDs from 1 to $numberOfRecords.
    $orderDate = $faker->date;
    $shippingAddressID = $faker->numberBetween(1, $numberOfRecords); // Assuming you have Address IDs from 1 to $numberOfRecords.
    $status = $statuses[array_rand($statuses)]; // Pick a random status from the $statuses array.

    // SQL query to insert data into Command table
    $sql = "INSERT INTO Command (Id_user, Date_command, Id_ShippingAddress, Status) VALUES (:userId, :orderDate, :shippingAddressId, :status)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':userId', $userID);
    $stmt->bindParam(':orderDate', $orderDate);
    $stmt->bindParam(':shippingAddressId', $shippingAddressID);
    $stmt->bindParam(':status', $status);

    // Execute the SQL query
    $stmt->execute();
}


// Insert data for the 'Invoices' table
for ($i = 0; $i < $numberOfRecords; $i++) {
    $commandID = $faker->numberBetween(1, $numberOfRecords); // Assuming you have Command IDs from 1 to $numberOfRecords.
    $invoiceDate = $faker->date;
    $totalAmount = $faker->randomFloat(2, 10, 1000);
    $paymentStatus = $faker->randomElement(['Paid', 'Unpaid']); // You can adjust the payment statuses as needed.

    // SQL query to insert data into Invoices table
    $sql = "INSERT INTO Invoices (Id_command, Date_invoices, TotalAmount, PaymentStatus) VALUES (:commandID, :invoiceDate, :totalAmount, :paymentStatus)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':commandID', $commandID);
    $stmt->bindParam(':invoiceDate', $invoiceDate);
    $stmt->bindParam(':totalAmount', $totalAmount);
    $stmt->bindParam(':paymentStatus', $paymentStatus);

    // Execute the SQL query
    $stmt->execute();
}



// Insert data for the 'Photo' table
for ($i = 0; $i < $numberOfRecords; $i++) {
    $userId = $faker->numberBetween(1, $numberOfRecords); // Assuming you have User IDs from 1 to $numberOfRecords.
    $productId = $faker->numberBetween(1, $numberOfRecords); // Assuming you have Product IDs from 1 to $numberOfRecords.
    $filePath = '/path/to/photo_' . $i . '.jpg'; // Replace with the actual file path.
    $caption = $faker->text;
    $uploadDate = $faker->dateTimeThisDecade()->format('Y-m-d H:i:s');

    // SQL query to insert data into Photo table
    $sql = "INSERT INTO Photo (Id_user, Id_product, FilePath, Caption, UploadDate) VALUES (:userId, :productId, :filePath, :caption, :uploadDate)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':filePath', $filePath);
    $stmt->bindParam(':caption', $caption);
    $stmt->bindParam(':uploadDate', $uploadDate);

    // Execute the SQL query
    $stmt->execute();
}


// Insert data for the 'Rate' table
for ($i = 0; $i < $numberOfRecords; $i++) {
    $userId = $faker->numberBetween(1, $numberOfRecords); // Assuming you have User IDs from 1 to $numberOfRecords.
    $productId = $faker->numberBetween(1, $numberOfRecords); // Assuming you have Product IDs from 1 to $numberOfRecords.
    $ratingValue = $faker->numberBetween(1, 5); // Assuming a 5-star rating system.
    $review = $faker->text;
    $date = $faker->date;

    // SQL query to insert data into Rate table
    $sql = "INSERT INTO Rate (Id_user, Id_product, RatingValue, Review, Date) VALUES (:userId, :productId, :ratingValue, :review, :date)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':ratingValue', $ratingValue);
    $stmt->bindParam(':review', $review);
    $stmt->bindParam(':date', $date);

    // Execute the SQL query
    $stmt->execute();
}


// Insert data for the 'Payment' table
for ($i = 0; $i < $numberOfRecords; $i++) {
    $userId = $faker->numberBetween(1, $numberOfRecords); // Assuming you have User IDs from 1 to $numberOfRecords.
    $paymentMethod = $faker->creditCardType;
    $cardNumber = $faker->creditCardNumber;

    // Generate a formatted expiration date
    $expirationDate = $faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'); // Adjust the date range as needed.

    // SQL query to insert data into Payment table
    $sql = "INSERT INTO Payment (Id_user, PaymentMethod, CardNumber, ExpirationDate) VALUES (:userId, :paymentMethod, :cardNumber, :expirationDate)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':paymentMethod', $paymentMethod);
    $stmt->bindParam(':cardNumber', $cardNumber);
    $stmt->bindParam(':expirationDate', $expirationDate);

    // Execute the SQL query
    $stmt->execute();
}



// Insérer des données dans la table 'Panier'
for ($i = 0; $i < $numberOfRecords; $i++) {
    // Générer un ID d'utilisateur valide
    $userId = $faker->numberBetween(1, $numberOfRecords);
    $productId = $faker->numberBetween(1, $numberOfRecords); // Vous pouvez générer un nombre aléatoire entre 1 et le nombre total de produits dans votre base de données.
    $quantity = $faker->numberBetween(1, 10); // Ajustez la plage de quantité selon vos besoins.

    // Requête SQL pour insérer des données dans la table Panier
    $sql = "INSERT INTO Panier (Id_user, Id_product, Quantité) VALUES (:userId, :productId, :quantity)";

    $stmt = $db->prepare($sql);
    $stmt = $pdo->prepare($sql);

    // Liens des paramètres
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':quantity', $quantity);

    // Exécuter la requête SQL
    $stmt->execute();
}

echo "Data inserted successfully!";
$pdo = null;

?>
</body>
</html>