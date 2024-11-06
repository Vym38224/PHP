<!doctype html>
<html lang="en">

<head>
    <title>Others</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            padding-top: 70px;
            /* Odsazení pro pevné záhlaví */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            /* Adjust this value based on your sidebar width */
            height: 100%;
            z-index: 100;
            padding: 48px 0 0;
            background-color: #343a40;
            /* Sidebar background color */
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 250px;
            /* Adjust this value based on your sidebar width */
        }
    </style>
</head>

<body>
    <header><?php require "assets/header.php"; ?></header>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3 main-content">
        <h1 class="pb-3 border-bottom">Others</h1>
        <!-- Obsah stránky Others -->
        <div id="user-list"></div>
    </main>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: './users.json',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var userList = $('#user-list');
                    userList.empty();
                    if (data.length > 0) {
                        var table = $('<table class="table table-striped"></table>');
                        var thead = $('<thead><tr><th>ID</th><th>Name</th><th>Surname</th></tr></thead>');
                        var tbody = $('<tbody></tbody>');
                        data.forEach(function(user) {
                            var row = $('<tr></tr>');
                            row.append('<td>' + user.id + '</td>');
                            row.append('<td>' + user.name + '</td>');
                            row.append('<td>' + user.surname + '</td>');
                            tbody.append(row);
                        });
                        table.append(thead);
                        table.append(tbody);
                        userList.append(table);
                    } else {
                        userList.append('<p>No users found.</p>');
                    }
                },
                error: function() {
                    $('#user-list').append('<p>Error loading user data.</p>');
                }
            });
        });
    </script>
</body>

</html>