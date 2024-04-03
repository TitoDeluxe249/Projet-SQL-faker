CREATE TABLE IF NOT EXISTS User (
    Id_user INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Mail VARCHAR(80) NOT NULL,
    Password VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS Address (
    Id_address INT AUTO_INCREMENT PRIMARY KEY,
    Id_user INT,
    Street VARCHAR(100) NOT NULL,
    City VARCHAR(50) NOT NULL,
    Zipcode VARCHAR(10) NOT NULL,
    Country VARCHAR(80) NOT NULL,
    FOREIGN KEY (Id_user) REFERENCES User(Id_user)
);

CREATE TABLE IF NOT EXISTS Product (
    Id_product INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Prix DECIMAL(10, 2) NOT NULL,
    Category VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Panier (
    Id_panier INT AUTO_INCREMENT PRIMARY KEY,
    Id_user INT,
    Id_product INT,  -- Changed to INT
    Quantité INT NOT NULL,
    FOREIGN KEY (Id_user) REFERENCES User(Id_user),
    FOREIGN KEY (Id_product) REFERENCES Product(Id_product)
);

CREATE TABLE IF NOT EXISTS Command (
    Id_command INT AUTO_INCREMENT PRIMARY KEY,
    Id_user INT,
    Date_command DATE NOT NULL,
    Id_ShippingAddress INT,
    Status VARCHAR(50),
    FOREIGN KEY (Id_user) REFERENCES User(Id_user),
    FOREIGN KEY (Id_ShippingAddress) REFERENCES Address(Id_address)
);

CREATE TABLE  IF NOT EXISTS Invoices (
    Id_invoices INT AUTO_INCREMENT PRIMARY KEY,
    Id_command INT,
    Date_invoices DATE NOT NULL,
    TotalAmount DECIMAL(10, 2) NOT NULL,
    PaymentStatus VARCHAR(20),
    FOREIGN KEY (Id_command) REFERENCES Command(Id_command)
);

CREATE TABLE IF NOT EXISTS Photo (
    Id_photo INT AUTO_INCREMENT PRIMARY KEY,
    Id_user INT,
    Id_product INT, 
    FilePath VARCHAR(255) NOT NULL,
    Caption TEXT,
    UploadDate DATETIME NOT NULL,
    FOREIGN KEY (Id_user) REFERENCES User(Id_user),
    FOREIGN KEY (Id_product) REFERENCES Product(Id_product)
);

CREATE TABLE IF NOT EXISTS Rate (
    Id_rate INT AUTO_INCREMENT PRIMARY KEY,
    Id_user INT,
    Id_product INT,
    RatingValue INT NOT NULL,
    Review TEXT,
    Date DATE NOT NULL,
    FOREIGN KEY (Id_user) REFERENCES User(Id_user),
    FOREIGN KEY (Id_product) REFERENCES Product(Id_product)
);

CREATE TABLE  IF NOT EXISTS Payment (
    Id_payment INT AUTO_INCREMENT PRIMARY KEY,
    Id_user INT,
    PaymentMethod VARCHAR(50) NOT NULL,
    CardNumber VARCHAR(16),
    ExpirationDate DATE,
    FOREIGN KEY (Id_user) REFERENCES User(Id_user)
);
