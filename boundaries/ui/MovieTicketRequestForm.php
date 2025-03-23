<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie System</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        /* Centered Heading */
        .heading {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;            
            color: #333;
        }

        
        /* Navigation Bar */
        .navbar {
            background: linear-gradient(45deg, #ff6600, #ffcc00);
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Menu List */
        .menu {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        /* Menu Items */
        .menu li {
            display: inline;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
        }

        /* Hover Effect */
        .menu a:hover {
            background: white;
            color: #ff6600;
            box-shadow: 0px 0px 10px rgba(255, 102, 0, 0.5);
        }

        /* Responsive Menu */
        @media (max-width: 600px) {
            .menu {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Menu -->
    <nav class="navbar">
        <ul class="menu">
            <li><a href="../../index.php">⬅️ Back</a></li>            
            <li><a href="./MovieSceduleView.php">🎬 View Movie Schedule</a></li>
            <li><a href="#">📞 Contact</a></li>
        </ul>
    </nav>

    <!-- Centered Heading -->
    <h1 class="heading">Movie Ticket Request Form 🎟️</h1>

</body>
</html>









