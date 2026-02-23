# PHP & Laravel Backend Engineering  
## Week 2 – Functions, Arrays & Forms  

**Program:** PHP & Laravel Backend Engineering  
**Week:** 2  
**Level:** Beginner  
**Duration:** 3 Days  

---

## Learning Objectives

By the end of this week, students will be able to:

- Create and use functions effectively
- Work with different types of arrays
- Process HTML forms in PHP
- Implement form validation and security
- Build interactive web applications

---

## Day 1 – PHP Functions

### What are Functions?

Functions are reusable blocks of code that perform specific tasks.

**Why use functions?**
- Code reusability
- Better organization
- Easier maintenance
- Modular programming

### Function Syntax

```php
// Function definition
function greet($name) {
    return "Hello, " . $name . "!";
}

// Function call
echo greet("John");  // Output: Hello, John!
```

### Types of Functions

1. **Built-in Functions**
   ```php
   $length = strlen("Hello");  // Returns 5
   $uppercase = strtoupper("hello");  // Returns "HELLO"
   ```

2. **User-defined Functions**
   ```php
   function add($a, $b) {
       return $a + $b;
   }
   ```

3. **Variable Scope**
   ```php
   $globalVar = 10;
   
   function test() {
       global $globalVar;  // Access global variable
       $localVar = 5;     // Local variable
       return $globalVar + $localVar;
   }
   ```

### Practical Exercises

1. Create a function that calculates the area of a rectangle
2. Write a function to check if a number is even or odd
3. Create a function that returns the factorial of a number
4. Build a temperature converter function (Celsius to Fahrenheit and vice versa)

---

## Day 2 – Arrays and Forms

### Working with Arrays

```php
// Indexed array
$colors = ["Red", "Green", "Blue"];

// Associative array
$student = [
    "name" => "Ali",
    "age" => 20,
    "grade" => "A"
];
```

### Common Array Functions

| Function | Description | Example |
|----------|-------------|---------|
| `count()` | Count elements | `count($colors)` |
| `array_push()` | Add to end | `array_push($colors, "Yellow")` |
| `array_pop()` | Remove from end | `array_pop($colors)` |
| `in_array()` | Check if value exists | `in_array("Red", $colors)` |
| `array_merge()` | Merge arrays | `array_merge($array1, $array2)` |

### Handling Forms

**HTML Form:**
```html
<form method="POST" action="process.php">
    <input type="text" name="username" required>
    <input type="email" name="email" required>
    <input type="submit" value="Submit">
</form>
```

**PHP Processing (process.php):**
```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        echo "Welcome, $username! Your email is $email";
    }
}
```

---

## Day 3 – Student Registration Form Project

### Project Requirements

Build a complete student registration system that:
1. Collects student information through a form
2. Validates all inputs
3. Stores data in an array
4. Displays a confirmation page

### Form Fields
- Full Name (required, letters only)
- Email (required, valid format)
- Password (required, min 8 chars)
- Course Selection (dropdown)
- Gender (radio buttons)
- Hobbies (checkboxes)
- Profile Picture (file upload)

### Sample Code Structure

**registration.php**
```php
<?php
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation and processing
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Only letters and spaces allowed in name";
    }
    
    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // If no errors, process form
    if (empty($errors)) {
        $studentData = [
            'name' => $name,
            'email' => $email,
            // Add other fields
        ];
        $success = true;
    }
}
?>

<!-- HTML Form -->
<form method="POST" enctype="multipart/form-data">
    <!-- Form fields go here -->
</form>
```

### Practice Exercises

1. Create a function that takes an array of numbers and returns the sum of all even numbers
2. Build a simple task list application that allows adding and removing tasks
3. Create a form that calculates the total price of selected items
4. Implement a simple login system with session management

### Resources

- [PHP Array Functions](https://www.php.net/manual/en/ref.array.php)
- [PHP Form Handling](https://www.w3schools.com/php/php_forms.asp)
- [OWASP Input Validation](https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html)
- [PHP Security Guide](https://www.php.net/manual/en/security.php)

### Tips for Success

- Always validate and sanitize user input
- Keep your code clean and well-organized
- Test your forms thoroughly
- Document your functions with comments
- Use proper error handling