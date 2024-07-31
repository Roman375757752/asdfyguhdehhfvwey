<?php
session_start();
$isLoggedIn = isset($_SESSION['userid']); // Проверка, авторизован ли пользователь
$username = $isLoggedIn ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCR App</title>
    <style>
        body {
            position: relative;
            background-color: #8C8C88;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #202426;
            position: relative;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
        }

        .logo h1 {
            margin: 0;
        }

        .search-container {
            position: relative;
            text-align: right;
            margin-top: 10px;
            width: 100%;
        }

        .search-container input[type="text"] {
            min-width: 200px;
            max-width: calc(100% - 100px);
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 40px;
            box-sizing: border-box;
            padding-right: 80px;
            transition: width 0.3s ease;
            width: 200px;
        }

        .search-container button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #202426;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
            cursor: pointer;
        }

        .dropdown-container {
            position: relative;
            margin-top: 10px;
        }

        .dropdown-button {
            display: inline-block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            padding: 10px;
            box-sizing: border-box;
            overflow-y: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .dropdown-section {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            text-align: center;
        }

        .dropdown-section a {
            color: black;
            padding: 8px 0;
            text-decoration: none;
            display: block;
        }

        .dropdown-section a:hover {
            background-color: #ddd;
        }

        .rectangle-area {
            width: 100%;
            max-width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #9DA65D;
            border-radius: 0px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="file"] {
            margin-bottom: 10px;
        }

        form button {
            padding: 10px 20px;
            background-color: #202426;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #333;
        }

        #result {
            text-align: center;
        }
    </style>
    <script>
        function adjustInputWidth() {
            const input = document.querySelector('.search-container input[type="text"]');
            const valueLength = input.value.length;
            input.style.width = `${Math.max(200, valueLength * 8)}px`;
        }

        document.addEventListener('input', adjustInputWidth);

        function showDropdown() {
            document.querySelector('.dropdown-content').style.display = 'flex';
        }

        function hideDropdown() {
            document.querySelector('.dropdown-content').style.display = 'none';
        }

        function setupDropdown() {
            const dropdownButton = document.querySelector('.dropdown-button');
            const dropdownContent = document.querySelector('.dropdown-content');

            let hideTimeout;

            dropdownButton.addEventListener('mouseenter', () => {
                clearTimeout(hideTimeout);
                showDropdown();
            });

            dropdownButton.addEventListener('mouseleave', () => {
                hideTimeout = setTimeout(hideDropdown, 300);
            });

            dropdownContent.addEventListener('mouseenter', () => {
                clearTimeout(hideTimeout);
            });

            dropdownContent.addEventListener('mouseleave', () => {
                hideTimeout = setTimeout(hideDropdown, 300);
            });
        }

        window.onload = () => {
            setupDropdown();
        };
    </script>
</head>
<body>
    <?php if ($isLoggedIn): ?>
        <div id="welcome-message">You have successfully logged in, <?php echo htmlspecialchars($username); ?>!</div>
    <?php endif; ?>

    <div class="header">
        <div class="header-top">
            <div class="logo">
                <h1>ZoomNetwork</h1>
            </div>
            <div class="search-container">
                <input type="text" placeholder="Search...">
                <button type="button">Enter</button>
            </div>
        </div>
        <div class="dropdown-container">
            <div class="dropdown-button">Select an option</div>
            <div class="dropdown-content">
                <div class="dropdown-section">
                    <a href="page1.html">Register</a>
                </div>
                <?php if (!$isLoggedIn): ?>
                    <div class="dropdown-section">
                        <a href="page2.html">Login</a>
                    </div>
                <?php endif; ?>
                <div class="dropdown-section">
                    <a href="page3.html">Advertisement</a>
                </div>
                <div class="dropdown-section">
                    <a href="page4.html">For suggestions</a>
                </div>
                <div class="dropdown-section">
                    <a href="page5.html">Open code</a>
                </div>
                <div class="dropdown-section">
                    <a href="user_dashboard.php">My Account</a>
                </div>
                <?php if ($isLoggedIn): ?>
                    <div class="dropdown-section">
                        <a href="logout.php">Logout</a>
                    </div>
                    <div class="dropdown-section">
                        <a href="add_item.html">Добавить товар</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="rectangle-area">
        <h2>Welcome to ZoomNetwork</h2>
        <p>Your content goes here.</p>
    </div>

    <form action="/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="image/*">
        <button type="submit">Upload</button>
    </form>
    <div id="result"></div>

    <script>
        document.querySelector('.dropdown-content').addEventListener('click', function(event) {
            if (event.target.tagName === 'A') {
                var selectedPage = event.target.href;
                if (selectedPage) {
                    window.location.href = selectedPage;
                }
            }
        });
    </script>
</body>
</html>
